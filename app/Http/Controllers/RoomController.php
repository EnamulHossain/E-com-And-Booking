<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Hotel;
use App\Models\Room;
use App\Repositories\HotelRepository;
use App\Repositories\RoomRepository;
use App\DataTables\RoomDataTable;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Prettus\Repository\Exceptions\RepositoryException;
use Prettus\Validator\Exceptions\ValidatorException;

use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    private $hotelRepository;
    private $roomRepository;
    public function __construct(HotelRepository $hotelRepo, RoomRepository $roomRepo)
    {
        parent::__construct();
        $this->hotelRepository = $hotelRepo;
        $this->roomRepository = $roomRepo;
    }
    // public function index(Request $request)
    // {
    //     try {
    //         if ($request->ajax()) {
    //             $data = Room::all();
    //             return DataTables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('room_number',  function(Room $room) {
    //                     return  $room->room_number;
    //                 })
    //                 ->addColumn('floor',  function(Room $room) {
    //                     return  $room->floor;
    //                 })
    //                 ->addColumn('amount',  function(Room $room) {
    //                     return  $room->amount ;
    //                 })
    //                 ->addColumn('available', function ($row) {
    //                     if($row->available == 1) {
    //                         return '<span class="badge bg-success">' . ($row->available == 0 ? "Not Available" : "Available") . '</span>';
    //                     }else {
    //                         return '<span class="badge bg-danger">' . ($row->available == 0 ? "Not Available" : "Available") . '</span>';
    //                     }
    //                 })

    //                 ->addColumn('action', function ($row) {
    //                     $btn = '<a href="' . route('rooms.edit', $row->id) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="edit"></i></a>
    //                            <a href="' . route('rooms.show', $row->id) . '" class="btn btn-sm btn-primary icon icon-left"><i data-feather="info"></i></a>
    //                            <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('rooms.destroy', $row->id) . '" name="delBtn"
    //                                                                class="btn btn-sm btn-danger icon icon-left "><i data-feather="trash-2"></i></button>';
    //                     return $btn;
    //                 })
    //                 ->rawColumns([ 'available','action'])
    //                 ->make(true);
    //         }
    //         return view('hotels.room.index');
    //     } catch (Exception $exception) {
    //         return $exception->getMessage();
    //     }
    // }
    public function index(RoomDataTable $roomDataTable)
    {
        return $roomDataTable->render('hotels.room.index');
    }
    public function create()
    {
        $hotels = Hotel::all();
        return view('hotels.room.create', ['hotels' => $hotels]);
    }
    public function store(RoomRequest $request)
    {
        dd('okk');
        try {
           $validated = $request->validated();
           if($validated)
           {
                $data = $request->all();
                Room::create($data);
                //return redirect()->route('rooms.index')->with('success', 'Room Created Successfully');
           }
        }catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }
        Flash::success(__('lang.saved_successfully', ['operator' => __('lang.room')]));

        return redirect(route('rooms.index'));

    }

    public function show($id)
    {
        $room = $this->roomRepository->findWithoutFail($id);

        if (empty($hotelLevel)) {
            Flash::error('E Provider Type not found');

            return redirect(route('rooms.index'));
        }

        return view('hotels.room.show')->with('room', $room);
    }

    public function edit($id)
    {
        $room = $this->roomRepository->findWithoutFail($id);
        $hotels = Hotel::all();
        return view('hotels.room.edit', ['hotels' => $hotels,'room'=>$room]);
    }
    public function update($id, RoomRequest $request)
    {
        $room = $this->roomRepository->findWithoutFail($id);

        if (empty($room)) {
            Flash::error('E Provider Type not found');
            return redirect(route('rooms.index'));
        }
        $input = $request->all();
        try {
            $room = $this->roomRepository->update($input, $id);           
        } catch (ValidatorException $e) {
            Flash::error($e->getMessage());
        }

        Flash::success(__('lang.updated_successfully', ['operator' => __('lang.room')]));

        return redirect(route('rooms.index'));
    }

    /**
     * Remove the specified HotelLevel from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $hotelLevel = $this->roomRepository->findWithoutFail($id);

        if (empty($hotelLevel)) {
            Flash::error('E Provider Type not found');

            return redirect(route('rooms.index'));
        }

        $this->roomRepository->delete($id);

        Flash::success(__('lang.deleted_successfully', ['operator' => __('lang.room')]));

        return redirect(route('rooms.index'));
    }
}
