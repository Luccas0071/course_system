<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    public function queryReportA()
    {

        $query = "  WITH count_courses AS (
                        SELECT 
                            use.id, 
                            use.name, 
                            use.email, 
                            COUNT(course.id) AS quantity_courses
                        FROM users AS use
                        LEFT JOIN courses AS course 
                            ON use.id = course.user_id
                        GROUP BY 
                            use.id, 
                            use.name
                    )
                    SELECT 
                        name,
                        email,
                        quantity_courses
                    FROM count_courses
                    WHERE 
                        quantity_courses = (SELECT MAX(quantity_courses) FROM count_courses) ";

        return DB::select($query);
    }

    public function queryReportB()
    {
        $query = "  WITH count_contents AS (
                        SELECT 
                            course.id,
                            course.title, 
                            course.description,
                            COUNT(course.id) AS quantity_contents
                        FROM courses AS course
                        LEFT JOIN modules AS module 
                            ON course.id = module.course_id
                        LEFT JOIN contents AS content 
                            ON module.id = content.module_id
                        GROUP BY 
                            course.id,
                            course.title
                    )
                    SELECT 
                        title, 
                        description,
                        quantity_contents
                    FROM count_contents
                    WHERE 
                        quantity_contents = (SELECT MAX(quantity_contents) FROM count_contents) ";

        return DB::select($query);
    }

    public function queryReportC()
    {
    $query  = " SELECT
                    course.id, 
                    course.title,
                    course.description,
                    COUNT(DISTINCT module.id) AS quantity_module,
                    COUNT(content.id) AS quantity_content
                FROM courses AS course
                LEFT JOIN modules AS module 
                    ON course.id = module.course_id
                LEFT JOIN contents AS content 
                    ON module.id = content.module_id
                GROUP BY
                    course.id
                ORDER BY
                    quantity_module DESC,
                    quantity_content DESC ";

        return DB::select($query);
    }

    public function queryReportD()
    {
    $query = "  SELECT
                    content.id,
                    content.title,
                    content.contents,
                    course.title AS course_title
                FROM contents AS content
                INNER JOIN modules AS module 
                    ON content.module_id = module.id
                INNER JOIN courses AS course 
                    ON module.course_id = course.id
                ORDER BY
                    course.title,
                    content.title ";

        return DB::select($query);
    }
}

