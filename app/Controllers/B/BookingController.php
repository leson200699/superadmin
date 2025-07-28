<?php

namespace App\Controllers\B;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\TourModel;

class BookingController extends BaseController
{
    protected $bookingModel;
    protected $tourModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->tourModel = new TourModel();
       helper(['session_helper', 'response_helper', 'sidebar_helper', 'permission_helper']);
    }

    public function index()
    {
        $data['title'] = 'Tour boooking';
        $data['bookings'] = $this->bookingModel->select('bookings.*, tours.name as tour_name')
            ->join('tours', 'tours.id = bookings.tour_id')
            ->findAll();
        return view('B/pages/booking/index', $data);
    }

    public function view($id)
    {
        $data['title'] = 'Tour boooking view';
        $data['booking'] = $this->bookingModel->select('bookings.*, tours.name as tour_name')
            ->join('tours', 'tours.id = bookings.tour_id')
            ->find($id);
        return view('B/pages/booking/view', $data);
    }

    public function book($tourId)
    {
        $data = [
            'tour_id' => $tourId,
            'customer_name' => $this->request->getPost('customer_name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'quantity' => $this->request->getPost('quantity'),
            'booking_date' => date('Y-m-d H:i:s'),
            'status' => 'pending',
        ];

        $this->bookingModel->insert($data);
        return redirect()->to('/admin/tours/view/' . $tourId)->with('success', 'Đặt tour thành công.');
    }
}