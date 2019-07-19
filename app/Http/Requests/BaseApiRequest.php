<?php

namespace App\Http\Requests;

use Symfony\Component\HttpFoundation\Response;

/**
 * This class is base class for all API request
 * @author Shyam
 */
class BaseApiRequest extends Request {

    protected $response = null;

    /**
     * Get data to be validated from the request.
     * This method is used to get json input for APIs and validate the data
     * @return array
     */
    protected function validationData() {
        $postData = Request::all();
        return $postData;
    }

    /**
     * This method is used to send custom response when validation fails
     * @param array $errors
     * @return type
     */
    public function response(array $errors) {
        $messages = implode(' ', array_flatten($errors));
        $first_error = '';
        foreach ($errors as $error) {
            $first_error = $error[0];
            break;
        }
        $this->response['message'] = $first_error;
        $this->response['errors'] = $errors;
        $this->response['success'] = false;

        return \Illuminate\Support\Facades\Response::json($this->response, Response::HTTP_BAD_REQUEST)->header('Content-Type', "application/json");
    }

}
