<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    protected $statusCode = 200;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respond($data, $headers = []) {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param $users
     * @return mixed
     */
    protected function respondWithPagination(LengthAwarePaginator $users, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count'  => $users->total(),
                'total_pages'  => ceil($users->total() / $users->perPage()),
                'current_page' => $users->currentPage()
            ]
        ]);

        return $this->respond($data);
    }

    public function respondInternalError($message = 'Internal Error!') {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    public function respondCreated($message)
    {
        return $this->setStatusCode(201)->respond([
            'message' => $message
        ]);
    }
}
