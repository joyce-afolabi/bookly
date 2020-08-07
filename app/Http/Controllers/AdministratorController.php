<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Reservation;
use App\Room;
use App\User;
use Illuminate\Http\Request;

class
AdministratorController extends Controller
{

    // staffs
   public function staffs(){

       $staffs = User::where('role','staff')->get();
       return view('admin.staffs.index',compact('staffs'));
   }

    public function createStaff(Request $request){


            $staff = new User;
            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->password = bcrypt('password');
            $staff->save();

            $staffs = User::where('role','staff')->get();
            return redirect('admin/staffs/')->with('staffs');


    }

    // staffs

    // customers
    public function customers(){

        $customers = Customer::all();
        return view('admin.customers.index',compact('customers'));
    }

    public function createCustomer(Request $request){


        $customer = new Customer;
        $customer->customer_id = $this->generateID(9);
        $customer->fullname = $request->fullname;
        $customer->email = $request->email;
        $customer->number = $request->number;
        $customer->address = $request->address;
        $customer->save();

        $customers = Customer::all();
        return redirect('admin/customers/')->with('customers');


    }

    // customers


    public function rooms(){
       $rooms = Room::all();

        return view('admin.rooms.index',compact('rooms'));
    }


    //rooms

    //reservations

    public function reservations(){

       $reservations = Reservation::with('Customer','Room')->get();
       $rooms = Room::where('status','available')->get();
       $customers = Customer::all();


        return view('admin.reservations.index',compact('reservations','rooms','customers'));

    }

    public function reservationsCreate(Request $request){

        $reservation = new Reservation;
        $reservation->reservation_id = $this->generateID(12);
        $reservation->customer_id = $request->customers;
        $reservation->room_id = $request->room;
        $reservation->save();

        $data = array('status' => 'booked');
        Room::where('room_id',$request->room)->update($data);

        $reservations = Reservation::with('Customer','Room')->get();
        $rooms = Room::where('status','available')->get();
        $customers = Customer::all();


        return redirect('admin/reservations/')->with('reservations','rooms','customers');




    }

    //reservations
}
