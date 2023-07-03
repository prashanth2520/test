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
        width: fit-content;
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
    }

    .text-areat-content {
        width: fit-content;
        font-size: 14px;
        font-weight: 500;
        color: #444;
    }
    .float-left{
        float: left;
    }
    img{
        padding-top: 5px;
    }

    /* .imgg{
        width: 100%;
        font-size: 16px;
        font-weight: 500;
        vertical-align: middle;
        word-wrap: break-word;
    }
    
    .imgg img{
        width: 20%;
        vertical-align: middle;
    }
    .unitmiles, .unitfeet{
        width: 100%;
        font-size: 16px;
        font-weight: 500;
        position: relative;
    } */

    

    
    </style>
</head>

<body>

    <div class="container">
        <div class='text-center'>
            <img src="{{asset('img/logo-side 1.png')}}" width="150px">
        </div>

       
        <div class="template-view-header ">
            <span class="left-title">Directions for:</span>
            <span class="right-title">{{ $record['form_name'] }}</span>
        </div>
      
      
        @if(isset($direction['from_location']))
        <div class="divide-section-view ">
            <span class="left-text-item">From:</span>
            <span class="right-text-item">{{ $direction['from_location'] }}</span>
        </div>
        @endif
      
      
      @if(isset($direction['latitude']))
      <div class="divide-section-view ">
          <span class="left-text-item">Latitude:</span>
          <span class="right-text-item">{{ $direction['latitude'] }}</span>
      </div>
      @endif
      
      
      @if(isset($direction['langitude']))
      <div class="divide-section-view ">
          <span class="left-text-item">Longitude:</span>
          <span class="right-text-item">{{ $direction['langitude'] }}</span>
      </div>
      @endif
      
      
      @if(isset($direction['drilling_rig_name']))
      <div class="divide-section-view ">
          <span class="left-text-item">Drilling Rig Name:</span>
          <span class="right-text-item">{{ $direction['drilling_rig_name'] }}</span>
      </div>
      @endif
      
      
      @if(isset($direction['drilling_rig_no']))
      <div class="divide-section-view ">
          <span class="left-text-item">Drilling Rig Number:</span>
          <span class="right-text-item">{{ $direction['drilling_rig_no'] }}</span>
      </div>
      @endif

        <div class="divide-section-view ">
            <span class="left-text-item">Old Location Name:</span>
            <span class="right-text-item">{{ $direction['old_location'] }}</span>
        </div>

        <div class="divide-section-view ">
            <span class="left-text-item">New Location Name:</span>
            <span class="right-text-item">{{ $direction['add_new_location'] }}</span>
        </div>

        @if(isset($direction['old_location_steps']))
        <div class="divide-section-view ">
            <span class="text-areat-content pop">@php echo htmlspecialchars_decode( $direction['old_location_steps'] )
                @endphp</span>
        </div>
        @endif
        
        @if(!$route_direction->isEmpty())
        <div style="page-break-after: auto"></div>
        @foreach ($route_direction as $route)

        @if(isset($direction['from_location']) && $route->label != 'Directions from Old Location to New Location')
        <div class="divide-section-view ">
            <span class="left-text-item">From:</span>
            <span class="right-text-item">{{ $direction['from_location'] }}</span>
        </div>
        @endif

        <div class="divide-section-view ">
            <span class="left-text-item">{{$route->label}}: </span>
            <span class="right-text-item">{{$route->labelName}}</span>
            <span class="right-text-item float-left">@php echo htmlspecialchars_decode($route['new_location'])@endphp</span>
        </div>

        @if($route->cattle_guards)
        <div class="divide-section-view ">
            <span class="left-text-item">#Cattle guards:</span>
            <span class="right-text-item">{{ $route->cattle_guards }}</span>
        </div>
        @endif

        @if($route->power_line)
        <div class="divide-section-view ">
            <span class="left-text-item">#Power line:</span>
            <span class="right-text-item">{{ $route->power_line }}</span>
        </div>
        @endif
        @if($route->other)
        <div class="divide-section-view ">
            <span class="left-text-item"># Other:</span>
            <span class="right-text-item">{{ $route->other }}</span>
        </div>
        @endif
        @endforeach
        @endif

        @if (isset($direction['customFields']) && count($direction['customFields']) > 0)
        @foreach ($direction['customFields'] as $custom_field)
        <div class="divide-section-view ">
            <span class="left-text-item">{{ $custom_field['label'] }}:</span>
            <span class="right-text-item">{{ $custom_field['value'] }}</span>
        </div>
        @endforeach
        @endif
    </div>
</body>

</html>