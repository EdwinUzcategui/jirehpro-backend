<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAddress;

class UserController extends Controller
{
    public function getUserDetails(Request $request)
    {
        try {

            $user = User::with('address')->find($request->id);

            $response = createResponse($user, 'Usuario consultado satisfactoriamente');

        } catch (\Exception $error) {
			$response = createError($error->getMessage());
		}

		return responseApi($response);
    }

    public function getUsers(Request $request)
    {
        try {

            $users = User::with('address')->get();

            $response = createResponse($users, 'Usuarios consultados satisfactoriamente');

        } catch (\Exception $error) {
			$response = createError($error->getMessage());
		}

		return responseApi($response);
    }

    public function storeUser(Request $request)
    {
        try {

            $rules = [
                'name' => 'required',
                'name' => 'required',
                'birth_date' => 'required',
                'age' => 'required',
                'address' => 'required'
            ];

            $validate = validateFields($rules, $request->all());

            if ($validate->fail) return response()->json($validate->response);

            $user = new User;
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->birth_date = $request->birth_date;
            $user->age = $request->age;
            $user->save();

            $user_address = UserAddress::create([
                'user_id' => $user->id,
                'street' => $request->address['street'],
                'no_outside' => $request->address['no_outside'],
                'colony' => $request->address['colony'],
                'zip' => $request->address['zip'],
                'city' => $request->address['city'],
                'country' => $request->address['country'],
                'latitude' => $request->address['latitude'],
                'longitude' => $request->address['longitude']
            ]);

            $user->address = $user_address;

            $response = createResponse($user, 'Usuario registrado satisfactoriamente');

        } catch (\Exception $error) {
			$response = createError($error->getMessage());
		}

		return responseApi($response);
    }

    public function updateUser(Request $request)
    {
        try {

            $rules = [
                'id' => 'required',
                'name' => 'required',
                'name' => 'required',
                'birth_date' => 'required',
                'age' => 'required',
                'address' => 'required'
            ];

            $validate = validateFields($rules, $request->all());

            if ($validate->fail) return response()->json($validate->response);

            $user = User::with('address')->findOrFail($request->id);

            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->birth_date = $request->birth_date;
            $user->age = $request->age;
            $user->save();

            $user->address()->delete();

            $user_address = UserAddress::create([
                'user_id' => $user->id,
                'street' => $request->address['street'],
                'no_outside' => $request->address['no_outside'],
                'colony' => $request->address['colony'],
                'zip' => $request->address['zip'],
                'city' => $request->address['city'],
                'country' => $request->address['country'],
                'latitude' => $request->address['latitude'],
                'longitude' => $request->address['longitude']
            ]);

            $user->address = $user_address;

            $response = createResponse($user, 'Usuario editado satisfactoriamente');

        } catch (\Exception $error) {
			$response = createError($error->getMessage());
		}

		return responseApi($response);
    }

    public function deleteUser(Request $request)
    {
        try {

            $rules = [
                'id' => 'required'
            ];

            $validate = validateFields($rules, $request->all());

            if ($validate->fail) return response()->json($validate->response);

            $user = User::with('address')->findOrFail($request->id);

            $user->address()->delete();

            $user->delete();

            $response = createResponse([], 'Usuario eliminado satisfactoriamente');

        } catch (\Exception $error) {
			$response = createError($error->getMessage());
		}

		return responseApi($response);
    }
}
