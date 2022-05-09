<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    private $company;

    /**
     * CompanyController constructor.
     * @param Company $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Support\MessageBag
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'phone' => 'required|string|digits:10',
        ]);

        if ($validate->fails()) {
            return $validate->errors();
        }

        $this->company->createCompany($request);

        return response()->json(['message' => 'Company created successfully.'], 200);
    }

    /**
     * @return JsonResponse
     */
    public function getUserCompanies(): JsonResponse
    {
        $companies = $this->company->getUserCompanies();

        return response()->json($companies);
    }
}
