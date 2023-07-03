<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Rig Routes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-size: 14px;
            font-family: 'Montserrat', sans-serif;
        }

        .page-break {
            page-break-after: always;
        }

        .center {
            text-align: center;
        }

        .divide-section-view.left-text-item {
            color: #7daddc;
        }

        .template-view-header {
            display: flex;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
            padding: 15px;
        }

        .float-left {
            float: left;
        }

        .left-title {
            text-align: right;
            padding: 0 5px;
            font-size: 20px;
            font-weight: 500;
            color: #7daddc;
        }

        .right-title {
            text-align: left;
            padding: 0 5px;
            font-size: 20px;
            font-weight: 500;
            color: #444;
        }

        .divide-section-view {
            width: 100%;
            margin-bottom: 15px;
        }

        .left-text-item {
            width: 50%;
            font-size: 14px;
            font-weight: 500;
            color: #7daddc;
        }

        .right-text-item {
            width: fit-content;
            font-size: 14px;
            font-weight: 500;
            color: #444;
            padding-left: 4px;
            line-height: 1.5;
            padding-top: 10px;
        }

        .text-areat-content {
            width: fit-content;
            font-size: 14px;
            font-weight: 500;
            color: #444;
        }

        .imgadd {
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .imgadd img {
            width: 20%;
            vertical-align: middle;
        }

        .unit {
            width: 100%;
            font-size: 16px;
            font-weight: 300;
            float: left;
            position: relative;
        }

        .unit:after {
            content: "";
            width: 70%;
            height: 1px;
            background: #d3d1d1;
            position: absolute;
            right: 0px;
            top: 20px;
        }

        .addimg {
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .addimg img {
            width: 20%;
            vertical-align: middle;
        }

        .addimg .pop1 {
            width: 100%;
            font-size: 16px;
            font-weight: 300;

            border-bottom: 1px solid #d3d1d1;
        }

        .addimg .pop1:after {
            content: "";
            width: 85%;
            height: 1px;
            background: #d3d1d1;
            position: absolute;
            right: 0px;
            top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class='text-center'>
        <img src="{{asset('img/logo-side 1.png')}}" width="150px">
        </div>
        <div class="template-view-header ">
            <span class="left-title">Route Assessment:</span>
            <span class="right-title">{{ $record['form_name'] }}</span>
        </div>
        <div>

        @if (isset($route_assessment['date_time']) && $route_assessment['date_time'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Date and time:</span>
                <span class="right-text-item">
                {{ $route_assessment['date_time'] }}    
                </span>
            </div>
         @endif
            
         @if(!$route_assessment->temperatureOption->isEmpty())
            <div class="divide-section-view ">
                <span class="left-text-item">Temp:</span>
                <span class="right-text-item">
                        @php
                        $temperature=[];
                        foreach($route_assessment->temperatureOption as $temperatureValues){
                            $temperature[]=$temperatureValues->temperature->name;
                        }
                        $tempValues = implode(', ', $temperature);
                        @endphp
                   
                    @if (isset($temperature))
                        {{ $tempValues }}
                    @endif
                </span>
            </div>
        @endif
            
        @if (isset($route_assessment['operator']) && $route_assessment['operator'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Operator:</span>
                <span class="right-text-item">
                 {{ $route_assessment['operator'] }}
                </span>
            </div>
        @endif
            
        @if (isset($route_assessment['operator_email']) && $route_assessment['operator_email'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Common man's email:</span>
                <span class="right-text-item">
                    {{ $route_assessment['operator_email'] }}
                </span>
            </div>
        @endif

        @if (isset($record['rig_name']) && $record['rig_name'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Rig:</span>
                <span class="right-text-item">
                    {{ $record['rig_name'] }}
                </span>
            </div>
        @endif

        @if (isset($route_assessment['rig_manager']) && $route_assessment['rig_manager'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Rig Manager:</span>
                <span class="right-text-item">
                    {{ $route_assessment['rig_manager'] }}
                </span>
            </div>
        @endif

        @if (isset($route_assessment['rig_email']) && $route_assessment['rig_email'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Rig email:</span>
                <span class="right-text-item">
                    {{ $route_assessment['rig_email'] }}
                </span>
            </div>
        @endif

        @if (isset($route_assessment['rig_phone']) && $route_assessment['rig_phone'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Rig phone:</span>
                <span class="right-text-item">
                    {{ $route_assessment['rig_phone'] }}
                </span>
            </div>
        @endif
        @if (isset($route_assessment['old_location']) && $route_assessment['old_location'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Old location:</span>
                <span class="right-text-item">
                    {{ $route_assessment['old_location'] }}
                </span>
            </div>
        @endif

        @if (isset($route_assessment['old_location_latitude']) && $route_assessment['old_location_latitude'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Latitude:</span>
                <span class="right-text-item">
                        {{ $route_assessment['old_location_latitude'] }}
                </span>
            </div>
        @endif

        @if (isset($route_assessment['old_location_longitude']) && $route_assessment['old_location_longitude'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Longitude:</span>
                <span class="right-text-item">
                        {{ $route_assessment['old_location_longitude'] }}
                </span>
            </div>
        @endif

        @if (isset($route_assessment['new_location']) && $route_assessment['new_location'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">New location:</span>
                <span class="right-text-item">
                    {{ $route_assessment['new_location'] }}
                </span>
            </div>
        @endif
        @if (isset($route_assessment['new_location_latitude']) && $route_assessment['new_location_latitude'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Latitude:</span>
                <span class="right-text-item">
                    {{ $route_assessment['new_location_latitude'] }}  
                </span>
            </div>
        @endif
        @if (isset($route_assessment['new_location_longitude']) && $route_assessment['new_location_longitude'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Longitude:</span>
                <span class="right-text-item">
                    {{ $route_assessment['new_location_longitude'] }}  
                </span>
            </div>
        @endif

        @if (isset($route_assessment['old_closest_emergency_room']) && $route_assessment['old_closest_emergency_room'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Closest police/Sheriff's office:</span>
                <span class="right-text-item">
                    {{ $route_assessment['old_closest_emergency_room'] }}
                </span>
            </div>
        @endif
        @if (isset($route_assessment['old_emergency']) && $route_assessment['old_emergency'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Emergency contact no:</span>
                <span class="right-text-item">
                        {{ $route_assessment['old_emergency'] }}
                </span>
            </div>
        @endif

            @if (isset($route_assessment['new_closest_emergency_room']) && $route_assessment['new_closest_emergency_room'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Closest Emergency room:</span>
                <span class="right-text-item">
                    {{ $route_assessment['new_closest_emergency_room'] }}
                </span>
            </div>
            @endif
            @if (isset($route_assessment['new_emergency']) && $route_assessment['new_emergency'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Emergency contact no:</span>
                <span class="right-text-item">
                    {{ $route_assessment['new_emergency'] }} 
                </span>
            </div>
            @endif

            @if (isset($route_assessment['assessment_new_location']) && $route_assessment['assessment_new_location'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Directions:</span>
                <span class="right-text-item">@php echo htmlspecialchars_decode($route_assessment['assessment_new_location']) @endphp
                </span>
            </div>
            @endif

            @if(!$route_direction->isEmpty())
            <div style="page-break-after: auto"></div>
            @foreach ($route_direction as $direction)
            @if (!$direction->hazard_id)
            <div class="divide-section-view ">
                <span class="left-text-item">{{$direction->label}}: </span>
                <span class="right-text-item">{{$direction->labelName}}</span>
                <span class="right-text-item float-left">@php echo htmlspecialchars_decode($direction['new_location'])@endphp</span>
            </div>

            @if($direction->cattle_guards)
            <div class="divide-section-view ">
                <span class="left-text-item">#Cattle guards:</span>
                <span class="right-text-item">{{ $direction->cattle_guards }}</span>
            </div>
            @endif

            @if($direction->power_line)
            <div class="divide-section-view ">
                <span class="left-text-item">#Power line:</span>
                <span class="right-text-item">{{ $direction->power_line }}</span>
            </div>
            @endif
            @if($direction->other)
            <div class="divide-section-view ">
                <span class="left-text-item"># Other:</span>
                <span class="right-text-item">{{ $direction->other }}</span>
            </div>
            @endif
            @endif
            @endforeach
            @endif
            @foreach ($route_direction as $index => $route)
            @if($route->hazard_id)
            <div class="divide-section-view ">
                @php
                    $checkValueExist='';
                    $checkValueExist=true;
                @endphp

                @if($route->labelName) 
                    @php
                    $checkValueExist=false;
                    @endphp
                    <p style="color:#000;"> {{$index+1}}{{'.'}}<span style="color: #556ecf; font-weight: 700;"> {{$route->labelName}}</span> </p>
                @endif

                
                @if(isset($route->distance)|| isset($route->getMeasurementBasedOnRecords) || isset($route->getHazardBasedOnRecords)|| isset($route->feet) || isset($route->inches) || isset($route->inches) || isset($route->instruction))
                    @php 
                        if($checkValueExist){
                            $checkValueExist = false;
                            @endphp
                                <p style="color:#000;"> {{$index+1}}{{'.'}}   
                                    <span style="color: #000; font-weight: 500;  margin: 10px;">{{$route->distance}} 
                                    @if($route->getMeasurementBasedOnRecords)
                                    {{$route->getMeasurementBasedOnRecords->name}}
                                    @endif
                                    </span>  <span style="color: #f84e4e; font-weight: 500;">
                                    @if($route->getHazardBasedOnRecords)
                                    {{$route->getHazardBasedOnRecords->name}}
                                    @endif
                                </span> 

                                @if($route->feet!==null)
                                    <span style="color: #f84e4e; font-weight: 500;">  {{$route->feet}}{{'\''}}</span> 
                                    @endif
                                @if($route->inches!==null)  <span style="color: #f84e4e; font-weight: 500;">{{$route->inches}}{{"\""}}</span>  @endif
                                <span  style="color: #f84e4e; font-weight: 500;">{{$route->instruction}}</span> </p>
                            @php 
                        }
                        else{
                            @endphp
                            <p style="color:#000;">  
                                    <span style="color: #000; font-weight: 500; margin:10px;">{{$route->distance}}  
                                    @if($route->getMeasurementBasedOnRecords)
                                    {{$route->getMeasurementBasedOnRecords->name}}
                                    @endif</span>  <span style="color: #f84e4e; font-weight: 500;">  
                                    @if($route->getHazardBasedOnRecords)
                                    {{$route->getHazardBasedOnRecords->name}}
                                    @endif</span> 
                                @if($route->feet!==null)
                                    <span style="color: #f84e4e; font-weight: 500;">  {{$route->feet}}{{'\''}}</span> 
                                    @endif
                                @if($route->inches!==null)  <span style="color: #f84e4e; font-weight: 500;">{{$route->inches}}{{"\""}}</span>  @endif
                                <span  style="color: #f84e4e; font-weight: 500;padding-left: 10px;">{{$route->instruction}}</span> 
                            </p>
                            @php
                        }
                        @endphp 
                @endif
                    
                @if($route->note) 
                    @php 
                        if($checkValueExist){
                            @endphp
                                <p style="color: #556ecf;font-weight: 500; margin: 10px;"> {{$index+1}}{{'.'}} {{$route->note}}</p>
                            @php
                        }else{
                            @endphp
                                <p style="color: #556ecf;font-weight: 500; margin: 10px;">{{$route->note}}</p>
                            @php
                        }
                    @endphp
                @endif
        

            </div>
            @endif

            @endforeach


            @if (isset($route_assessment['total_miles']) && $route_assessment['total_miles'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Total miles:</span>
                <span class="right-text-item">
                    {{ $route_assessment['total_miles'] }}
                </span>
            </div>
            @endif

            @if (isset($route_assessment['total_cattle_gaurds']) && $route_assessment['total_cattle_gaurds'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Total Power Lines:</span>
                <span class="right-text-item">
                    {{ $route_assessment['total_cattle_gaurds'] }}
                </span>
            </div>
            @endif
            @if (isset($route_assessment['total_overhead_harzards']) && $route_assessment['total_overhead_harzards'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Total overhead hazards bridges, traffic lights, guide wire:</span>
                <span class="right-text-item">
                    {{ $route_assessment['total_overhead_harzards'] }}  
                </span>
            </div>
            @endif

            @if (isset($route_assessment['total_guide_wire']) && $route_assessment['total_guide_wire'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Total Guide Wire:</span>
                <span class="right-text-item">
                        {{ $route_assessment['total_guide_wire'] }}
                </span>
            </div>
            @endif
            @if (isset($route_assessment['lowest_overhead_harzards']) && $route_assessment['lowest_overhead_harzards'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Lowest overhead Hazard:</span>
                <span class="right-text-item">
                    
                        {{ $route_assessment['lowest_overhead_harzards'] }}
                  
                    
                </span>
                @if($route_assessment['lowest_overhead_harzards_feet']!==null)
                <span style="color: #f84e4e; font-weight: 500;">  {{$route_assessment['lowest_overhead_harzards_feet']}}{{'\''}}</span> 
                @endif
                @if($route_assessment['lowest_overhead_harzards_inches']!==null)
                <span style="color: #f84e4e; font-weight: 500;">  {{$route_assessment['lowest_overhead_harzards_inches']}}{{"\""}}</span> 
                @endif
            </div>
            @endif
            @if (isset($route_assessment['lowest_power_line']) && $route_assessment['lowest_power_line'] != '')
            <div class="divide-section-view ">
                <span class="left-text-item">Lowest power Line:</span>
                <span class="right-text-item">
                    {{ $route_assessment['lowest_power_line'] }}
                </span>
                @if($route_assessment['lowest_power_line_feet']!==null)
                <span style="color: #f84e4e; font-weight: 500;">  {{$route_assessment['lowest_power_line_feet']}}{{'\''}}</span> 
                @endif
                @if($route_assessment['lowest_power_line_inches']!==null)
                <span style="color: #f84e4e; font-weight: 500;">  {{$route_assessment['lowest_power_line_inches']}}{{"\""}}</span> 
                @endif
            </div>
            @endif

            @if(isset($route_assessment['direction_new_location']))
            <div class="divide-section-view">
                <span class="text-areat-content">@php echo htmlspecialchars_decode($route_assessment['direction_new_location']); @endphp</span>
            </div>
            @endif
            
            @if (isset($route_assessment['customFields']) && count($route_assessment['customFields']) > 0)
                @foreach ($route_assessment['customFields'] as $custom_field)
                    <div class="divide-section-view ">
                        <span class="left-text-item">{{ $custom_field['label'] }}:</span>
                        <span class="right-text-item">{{ $custom_field['value'] }}</span>
                    </div>
                @endforeach
            @endif
            <div class="form-blk">
                @if(isset($route_assessment['route_assessor_name']) || isset($route_assessment['route_assessor_email']) || isset($route_assessment['route_assessor_phone']))
                <div class="left-text-item">Route assessment completed by:</div>
                @endif
                @if (isset($route_assessment['route_assessor_name']) && $route_assessment['route_assessor_name'] != '')
                <div class="divide-section-view ">
                    <span class="left-text-item">Name:</span>
                    <span class="right-text-item">
                            {{ $route_assessment['route_assessor_name'] }}
                    </span>
                </div>
                @endif
                @if (isset($route_assessment['route_assessor_email']) && $route_assessment['route_assessor_email'] != '')
                <div class="divide-section-view ">
                    <span class="left-text-item">Email:</span>
                    <span class="right-text-item">
                            {{ $route_assessment['route_assessor_email'] }}
                      
                    </span>
                </div>
                @endif
                @if (isset($route_assessment['route_assessor_phone']) && $route_assessment['route_assessor_phone'] != '')
                <div class="divide-section-view ">
                    <span class="left-text-item">Phone:</span>
                    <span class="right-text-item">
                            {{ $route_assessment['route_assessor_phone'] }}
                    </span>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
