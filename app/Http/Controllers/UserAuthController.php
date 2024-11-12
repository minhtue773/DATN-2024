<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleLogin;
use App\Http\Requests\RuleNhap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class UserAuthController extends Controller
{
    public function register()
    {
        return view('clients.register');
    }
    public function registerUser(RuleNhap $req)
    {
        $req->merge(['password' => Hash::make($req->password)]);
        try {
            User::create($req->all());
        } catch (\Throwable $th) {
            dd($th);
        }
        return  redirect()->route('login');
    }
    public function login()
    {
        return view('clients.login');
    }
    public function loginUser(RuleLogin $req)
    {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            // Thêm thông báo đăng nhập thành công
            session()->flash('success', 'Đăng nhập thành công!');

            // Kiểm tra nếu có URL checkout trong session và chuyển hướng về đó
            if (session()->has('checkout_url')) {
                $checkoutUrl = session('checkout_url');
                session()->forget('checkout_url'); // Xóa URL đã lưu trong session
                return redirect($checkoutUrl);
            }

            // Nếu không, chuyển hướng về trang home hoặc nơi khác
            return redirect()->route('home');
        }

        return redirect()->back()->with('error', 'Sai mật khẩu hoặc tài khoản');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        if ($request->hasCookie('remember_token')) {
            Cookie::forget('remember_token');
        }
        return redirect('/');
    }
    public function showAccount()
    {
        // Lấy thông tin người dùng đã đăng nhập
        $user = Auth::user();

        // Nếu người dùng chưa đăng nhập, có thể chuyển hướng về trang đăng nhập hoặc thông báo lỗi
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem thông tin tài khoản.');
        }

        // Lấy danh sách sản phẩm yêu thích của người dùng
        // Lưu ý rằng chúng ta sẽ lấy danh sách yêu thích qua quan hệ
        $favoriteProducts = $user->favoritedBy()->get();// Phân trang 9 sản phẩm mỗi trang

        // Chỉ định biến index1 cho mục đích nào đó trong view
        $index1 = 0;

        $index1 = 1;
        $cart = session('cart', []);
        $user = Auth::user();

        $addressDetail = $tinh = $quan = $phuong = '';

        if ($user && $user->address) {
            $addressParts = explode(', ', $user->address);
            $addressDetail = $addressParts[0] ?? '';
            $phuongId = $addressParts[1] ?? '';
            $quanId = $addressParts[2] ?? '';
            $tinhId = $addressParts[3] ?? '';

            // API tên Tỉnh
            $tinh = $this->getLocationName('https://esgoo.net/api-tinhthanh/1/0.htm', $tinhId);

            // API tên Quận
            $quan = $this->getLocationName("https://esgoo.net/api-tinhthanh/2/{$tinhId}.htm", $quanId);

            // API tên Phường
            $phuong = $this->getLocationName("https://esgoo.net/api-tinhthanh/3/{$quanId}.htm", $phuongId);
        }


        // Trả về view cùng với thông tin người dùng và danh sách sản phẩm yêu thích
        return view('clients.my_account', compact('user', 'favoriteProducts', 'index1', 'addressDetail', 'tinh', 'quan', 'phuong'));
    }
    private function getLocationName($url, $locationId)
    {
        try {
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if ($data['error'] == 0) {
                foreach ($data['data'] as $location) {
                    if ($location['id'] == $locationId) {
                        return $location['full_name'];
                    }
                }
            }
        } catch (Exception $e) {
            // Xử lý lỗi
        }

        return '';
    }
    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'addressDetail' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:5120', // tối đa 5MB
        ]);

        $user = Auth::user();

        // Lấy địa chỉ đã lưu trước đó và phân tách thành các phần
        $addressParts = explode(', ', $user->address);
        $originalData = [
            'name' => $user->name,
            'phone_number' => $user->phone_number,
            'addressDetail' => $addressParts[0] ?? '',
            'phuong' => $addressParts[1] ?? '',
            'quan' => $addressParts[2] ?? '',
            'tinh' => $addressParts[3] ?? '',
            'email' => $user->email,
        ];

        // Lấy dữ liệu mới từ request hoặc giữ nguyên dữ liệu cũ nếu không có thay đổi
        $newData = [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'addressDetail' => $request->input('addressDetail', $originalData['addressDetail']),
            'phuong' => $request->input('phuong', $originalData['phuong']),
            'quan' => $request->input('quan', $originalData['quan']),
            'tinh' => $request->input('tinh', $originalData['tinh']),
            'email' => $request->email,
        ];

        // Kiểm tra nếu có thay đổi
        if (array_diff_assoc($newData, $originalData)) {
            // Cập nhật dữ liệu người dùng
            $user->name = $newData['name'];
            $user->phone_number = $newData['phone_number'];
            $user->address = $newData['addressDetail'] . ', ' . $newData['phuong'] . ', ' . $newData['quan'] . ', ' . $newData['tinh'];
            $user->email = $newData['email'];

            // Kiểm tra và xử lý ảnh đại diện mới
            if ($request->hasFile('photo')) {
                if ($user->image && file_exists(public_path('uploads/images/user/' . $user->image))) {
                    unlink(public_path('uploads/images/user/' . $user->image));
                }
                $imgName = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('uploads/images/user/'), $imgName);
                $user->image = $imgName;
            }

            $user->save();

            return  redirect()->back()->with('success', 'Thông tin đã được cập nhật!');
        } else {
            return redirect()->back()->with('success', 'Không có thay đổi nào được thực hiện.');
        }
    }
}
