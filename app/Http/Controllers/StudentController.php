<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    function createStudent (Request $request)
    {
        $student = Student::create([
            "name" => $request->name,
            "description" => $request->description,
            "class" => $request->class,
            "phone" => $request->phone,
            "cnic" => $request->cnic,
            "role_id" => $request->role_id,
            "status" => true
        ]);
        if ($student)
        {
            $token = $student->createToken("token")->plainTextToken;
            if ($token) 
            {
                $student->role = createRole($request->role_name);
                return ['result' => 'success', 'student' => $student, 'token' => $token];
            } 
            else
            {
                return ['result' => 'fail', 'message' => 'token not created'];
            } 
        }
    }

    function updateStudent (Request $request, $student_id)
    {
        if (Student::where("id", $student_id)->where('status', true)->exists())
        {
            $updatedStudent = Student::where("id", $student_id)->update([
                "name" => $request->name,
                "description" => $request->description,
                "class" => $request->class,
                "phone" => $request->phone,
                "cnic" => $request->cnic,
            ]);
            if ($updatedStudent)
            {
                $student = Student::where("id", $student_id)->where("status", true)->first();
                if ($student)
                {
                    return ['result' => 'success', 'updated_Student' => $student];
                } 
                else 
                {
                    return ['result' => 'fail', 'nessage' => 'Unable to update User, Make sure to enter all fields'];
                }
            }
        }
        else 
        {
            return ['result' => 'fail', "message" => "No student found by this Id:".$student_id];
        }
    }

    function getStudentById ($student_id)
    {
        if (Student::where("id", $student_id)->where('status', true)->exists())
        {
            $student = Student::where("id", $student_id)->where("status", true)->first();
            if ($student)
            {
                return ['result' => 'success', 'student' => $student];
            }
            else 
            {
                return ['result' => 'fail', 'message' => 'No Student Found' ];   
            }
        }
        else 
        {
            return ['result' => 'fail', "message" => "No student found by this Id:".$student_id];
        }
    }

    function getAllStudent ()
    {
        $allStudents = Student::where("status", true)->get();
        return ['result' => 'success', "allStudents" => $allStudents];
    }

    function deactivateStudent ($student_id)
    {
        if (Student::where("id", $student_id)->where('status', true)->exists())
        {
            $deactivateStudent = Student::where("id", $student_id)->update([
                "status" => false
            ]);
            if ($deactivateStudent)
            {
                return ['result' => 'success', 'message' => 'student deactivated successfully'];
            } 
            else 
            {
                return ['result' => 'fail' ]; 
            }   
        } 
        else 
        {
            return ['result' => 'fail', 'message' => "student already deactivated"];
        }
    }

    function activateStudent ($student_id)
    {
        if (Student::where("id", $student_id)->where('status', false)->exists())
        {
            $activateStudent = Student::where("id", $student_id)->update([
                "status" => true
            ]);
            if ($activateStudent)
            {
                return ['result' => 'success', 'message' => 'student activated successfully'];
            } 
            else 
            {
                return ['result' => 'fail', 'message' => 'No Student Found' ]; 
            }   
        } 
        else 
        {
            return ['result' => 'fail', 'message' => "student already activated"];
        }
    }

    function deleteStudent ($student_id)
    {
        if (Student::where("id", $student_id)->where('status', true)->exists())
        {
            $delete = Student::where("id", $student_id)->delete();
            if ($delete)
            {
                return ['result' => 'success', 'message' => 'student deleted Successfully'];
            } 
            else 
            {
                return ['result' => 'fail', 'message' => 'No Student Found' ]; 
            }
        }
        else 
        {
            return ['result' => 'fail', "message" => "No student found by this Id:".$student_id];
        }
    }
}
