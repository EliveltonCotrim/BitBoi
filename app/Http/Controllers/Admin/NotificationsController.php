<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateNotifications;
use App\Http\Controllers\Controller;
use App\Models\NotificationsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class NotificationsController extends Controller {

    private $dados;
    private $notifications;

    public function __construct(NotificationsModel $notifications) {
        $this->notifications = $notifications;
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->dados['notifications'] = $this->notifications->paginate(10);
        return view('admin.notifications.notifications_list', $this->dados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
         $this->dados['titulo'] = 'notifications';
         return view('admin.notifications.notifications_create', $this->dados);
    }
    
    public function store(StoreUpdateNotifications $request) {
            $this->notifications->create($request->all());
            return redirect('admin/notifications');
    }

  public function show($id)
    {
        if (!$notifications = $this->notifications->find($id)) {
            return redirect()->back();
        }

       $this->dados['titulo'] = 'notifications';
       $this->dados['notifications'] = $notifications;
        return view('admin.notifications.notifications_show', $this->dados);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\{notifications}Model  $notifications
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
            $notifications = $this->notifications->find($id);
            $this->dados['notifications'] = $notifications;
            $this->dados['titulo'] = 'notifications';
            return view('admin.notifications.notifications_edit', $this->dados);
    }
    
    public function update(StoreUpdateNotifications $request, $id) {
            $this->notifications->find($id)->update($request->all());
            return redirect('admin/notifications');
    }

    public function delete(Request $request, $id) {
        if ($request->isMethod('post')) {
            $input = $request->except(['_token']);
            notificationsModel::where('id', $id)->delete();
            return redirect('/admin/notifications');
        } else {
            $notifications = notificationsModel::where('id', $id)->first();
            $this->dados['notifications'] = $notifications;
            $this->dados['titulo'] = 'notifications';
            return view('admin/notifications.notifications_delete', $this->dados);
        }
    }

     /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('title');

        $notifications = $this->notifications
                            ->where(function($query) use ($request) {
                                if ($request->title) {
                                    $query->where('title', $request->title);
                                }
                            })
                            ->latest()
                            ->paginate();

        return view('admin.notifications.notifications_list', compact('notifications', 'filters'));
    }
    }