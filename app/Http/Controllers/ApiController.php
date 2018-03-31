<?php
/**
 * Created by PhpStorm.
 * User: berni
 * Date: 30/03/18
 * Time: 21:03
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
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

    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    protected function respondWithPagination(LengthAwarePaginator $lessons, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count'  => $lessons->total(),
                'total_pages'  => ceil($lessons->total() / $lessons->perPage()),
                'current_page' => $lessons->currentPage(),
                'limit' => $lessons->perPage()
            ]

        ]);

        return $this->respond($data);
    }

    public function respondWithError($message)
    {
        return $this->respond([
            'error'=> [
                'message' => $message,
                'status_code'=> $this->getStatusCode()
            ]
        ]);
    }

    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(Response::HTTP_NOT_FOUND)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    protected function respondCreated($message)
    {
        return $this->setStatusCode(201)->respond([
            'message' => $message
        ]);

    }


}