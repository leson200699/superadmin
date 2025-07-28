<?

namespace App\Controllers\F;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\Car_Model;
use App\Models\CarCategory_Model;
use CodeIgniter\HTTP\ResponseInterface;

class Car extends BaseFrontendController
{
    protected $carModel;

    public function __construct()
    {
        $this->carModel = new Car_Model();
    }

    public function index()
    {
        $carModel = new Car_Model();
        $cars = $carModel->where('user_id', $this->user['id'])->findAll();

        return view("F/{$this->user['username']}/car_list", ['cars' => $cars]);
    }

    public function detail($slug)
    {
        $username = $this->user['username']; // <- lấy username nè
        $carDetail = $this->carModel->get_car_detail($slug);
        $userId = $this->user['id'];
    
        if (!$carDetail) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        $colors = $this->carModel->get_car_colors($carDetail['id']);
        return view('F/' . $username . '/car_detail', [
            'title' =>  $carDetail['name'],
            'carDetail' => $carDetail,
            'colors' => $colors,
        ]);
    }

}
