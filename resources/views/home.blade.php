<!DOCTYPE html>
<html>
    <head>
        <title>Job Applicants Report</title>
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.9.1/build/cssreset/cssreset-min.css">
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.9.1/build/cssbase/cssbase-min.css">
        <style type="text/css">
            #page {
                width: 1200px;
                margin: 30px auto;
            }
            .job-applicants {
                width: 100%;
            }
            .job-name {
                text-align: center;
            }
            .applicant-name {
                width: 150px;
            }
        </style>
    </head>
    <body>
        <div id="page">
            <table class="job-applicants">
                <thead>
                    <tr>
                        <th>Job</th>
                        <th>Applicant Name</th>
                        <th>Email Address</th>
                        <th>Website</th>
                        <th>Skills</th>
                        <th>Cover Letter Paragraph</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($jobs as $job)
                        <tr>
                        <td rowspan="{{$job->count_unique_applicant_skills()}}" class="job-name">{{$job->name}}</td>
                        
                        <!-- Loop through all of the applicants for each job. If the applicant does not have any skills then default rowspan to 1. -->
                        @foreach($job->applicants as $applicant)
                            <td rowspan="{{($applicant->unique_skills()) ? $applicant->unique_skills()->count() : '1'}}" class="applicant-name">{{$applicant->name}}</td>
                            
                            <!-- If applicant is missing email do not add href and default to '---' -->
                            <td rowspan="{{($applicant->unique_skills()) ? $applicant->unique_skills()->count() : '1'}}">
                                <a {{($applicant->email) ? "href='" . $applicant->email . "'" : ""}}>{{$applicant->email OR "---"}}</a>
                            </td>
                            <td rowspan="{{($applicant->unique_skills()) ? $applicant->unique_skills()->count() : '1'}}">
                                <a {{($applicant->website) ? "href='" . $applicant->website . "'" : ""}}">{{$applicant->website OR "---"}}</a>
                            </td>
                            <td rowspan="1">{{$applicant->unique_skills()[0]->name OR "---"}}</td>
                            <td rowspan="{{($applicant->unique_skills()) ? $applicant->unique_skills()->count() : '1'}}">{{$applicant->cover_letter OR "---"}}</td>
                            </tr>
                            
                            <!-- If applicant has more than one skill loop through and add them to the table -->
                            @for ($i = 1; $i < $applicant->unique_skills()->count(); $i++)
                                <tr>
                                    <td rowspan="1">{{$applicant->unique_skills()[$i]->name OR ""}}</td>
                                </tr>    
                            @endfor
                        @endforeach
                    @endforeach
                    </tr>
                </tbody>

                <tfooter>
                    <tr>
                        <td colspan="6">{{$applicants->count()}} Applicants, {{$skills->unique('name')->count()}} Unique Skills</td>
                    </tr>
                </tfooter>
            </table>
        </div>
    </body>
</html>
