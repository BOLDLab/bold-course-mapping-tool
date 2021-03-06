<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Course Mapping Tool</title>

    <!-- Bootstrap core CSS -->
    <link href="/course_mapping_tool/css/bootstrap.min.css" rel="stylesheet">
    <link href="/course_mapping_tool/css/theme.min.css" rel="stylesheet">
	<link href="/course_mapping_tool/css/chosen.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Course Mapping Tool</a>
        </div>
       
      </div>
    </nav>

    <div class="container" id="main">
    <h2>Courses</h2>
		<table class="table table-striped table-hover" id="courses">
		</table>
    </div> <!-- /container -->
	
	<div class="container" id="controls">
			<a href="#add_course"><button type="button" class="btn btn-primary" id="add_course">Add Course</button></a>
		
		
	</div>

<script id="modalDialog" type="text/template">
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <%= header %>
            </div>
            <div class="modal-body">
               <%= message %>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
</script>

      <script id="modalDialogOK" type="text/template">
	<div class="modal fade" id="alert-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <%= header %>
            </div>
            <div class="modal-body">
               <%= message %>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
</script>
	
<script id="homeControls" type="text/template">
	<a href="#add_course"><button type="button" class="btn btn-primary" id="add_course">Add Course</button></a>
</script>	

<script id="addCourseControls" type="text/template">
<a href="/course_mapping_tool"><button type="button" class="btn btn-primary" id="back">&larr; Back</button></a>
<a href="#learning_outcomes/<%= id %>"><button type="button" class="btn btn-primary" id="next">Next &rarr;</button></a>
</script>

<script id="learningOutcomesControls" type="text/template">
<a href="#edit_course/<%= course_id %>"><button type="button" class="btn btn-primary" id="back">&larr; Back</button></a>
<a href="#learning_activities/<%= course_id %>"><button type="button" class="btn btn-primary" id="next">Next &rarr;</button></a>
</script>

<script id="learningActivitiesControls" type="text/template">
<a href="#learning_outcomes/<%= course_id %>"><button type="button" class="btn btn-primary" id="back">&larr; Back</button></a>
<a href="#assessments/<%= course_id %>"><button type="button" class="btn btn-primary" id="next">Next &rarr;</button></a>
</script>

<script id="assessmentsControls" type="text/template">
<a href="#learning_activities/<%= course_id %>"><button type="button" class="btn btn-primary" id="back">&larr; Back</button></a>

<a href="#summary/<%= course_id %>"><button type="button" class="btn btn-primary" id="back">Summary</button></a>
</script>

<script id="criteriaControls" type="text/template">
<a href="#assessments/<%= course_id %>"><button type="button" class="btn btn-primary" id="back">&larr; Back</button></a>

<a href="#summary/<%= course_id %>"><button type="button" class="btn btn-primary" id="back">Summary</button></a>
</script>

<script id="summaryControls" type="text/template">
	<button type="button" class="btn btn-primary" onClick="{ window.history.back(); }">&larr; Back</button>
</script>

<script id="addCourseForm" type="text/template">
<h2>Step 1 of 4. Course Details</h2>      
	<form role="form">
    <div class="form-group">
      <label for="usr">Course Name:</label>
      <input type="text" class="form-control" id="name" value="<%= name %>">
    </div>
    <div class="form-group">
      <label for="pwd">Course Code:</label>
      <input type="text" class="form-control" id="code" value="<%= code %>">
    </div>
    <div class="form-group">
      <label for="duration">Course Duration (wks):</label>
     	<input type="text" class="form-control" id="duration" value="<%= duration %>">
    </div>
  </form>
</script>
 
<script id='learningOutcomesForm' type="text/template">
<h2>Step 2 of 4. Learning Outcomes</h2>      
  <table class="table table-striped">
    <thead>
      <tr>
       <th> <button type="button" class="btn btn-xs btn-default" id="add_row">+</button></th>
        <th>Outcome Name</th>
        <th>Outcome Details</th>
      </tr>
    </thead>
  </table>
</script>

<script id='learningActivitiesForm' type="text/template">
<h2>Step 3 of 4. Learning Activities</h2>    
  <table class="table table-striped">
    <thead>
      <tr>
       <th> <button type="button" class="btn btn-xs btn-default" id="add_row">+</button></th>
        <th>Activity</th>
		<th>Week</th>
        <th>Details</th>
		<th>Learning Outcomes</th>
      </tr>
    </thead>
  
    
  </table>
</script>

<script id='assessmentsForm' type="text/template">
<h2>Step 4 of 4. Assessments</h2>    
<table class="table table-striped" id="assessments">
<thead>
  <tr>
    <th> <button type="button" class="btn btn-xs btn-default" id="add_row">+</button></th>
    <th>Assessment</th>
    <th>Details</th>
	<th>Wk</th>
	<th>Weight</th>
	<th>LOs</th>
	<th></th>
  </tr>
</thead>

</table>
</script>

<script id='criteriaForm' type="text/template">
<h2>Rubric</h2>    
<table class="table table-striped" id="assessments">
<thead>
  <tr>
    <th> <button type="button" class="btn btn-xs btn-default" id="add_row">+</button></th>
    <th>Criterion</th>
    <th>F</th>
	<th>P</th>
	<th>C</th>
	<th>D</th>
	<th>HD</th>
  </tr>
</thead>

</table>
</script>

<script id='summaryForm' type="text/template">
<h2>Summary</h2>    
<table class="table table-bordered" id="summary">
<thead>
  <tr>
    <th>Learning Outcome</th>
    <th>Learning Activity</th>
	<th>Assessment</th>
  </tr>
</thead>

</table>
</script>

<script id="courseRow" type="text/template">
	<td><%= name %></td><td><%= code %></td><td><%= duration %> <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#confirm-delete" id="delete" style="float: right">-</button></td>
</script>

<script id="learningOutcomeRow" type="text/template">
	<td><button type="button" class="btn btn-xs btn-danger" id="delete" data-id="<%= id %>">-</button></td></td><td><input type='text' value='<%= name %>' size='12' id='name' class='form-control'></td><td><textarea class='form-control' id='details'><%= details %></textarea></td>
</script>

<script id="learningActivityRow" type="text/template">
	<td><button type="button" class="btn btn-xs btn-danger" id="delete" data-id="<%= id %>">-</button></td>
	<td>
		<p><input type='text' value='<%= name %>' size='12' id='name' class='form-control'></p>
		<label for="type" class="control-label">Type: </label>
		<select id="type" style='width: 100px'> 
		<%= type %>
		</select>
	</td>
	<td><input type='text' value='<%= week %>' size='2' id='week' class='form-control input-sm'></td>
	<td><textarea class='form-control' id='details' class='expanding'><%= details %></textarea></td>
	<td><select multiple id="learning_outcomes" class='form-control'><%= learning_outcomes %></select></td>
</script>

<script id="assessmentRow" type="text/template">
	<td><button type="button" class="btn btn-xs btn-danger" id="delete" data-toggle="modal" data-target="#confirm-delete" data-id="<%= id %>">-</button></td>
	<td>
		<p><input type='text' value='<%= name %>' size='20' id='name' class='form-control input-sm'> </p>
		<label for="type" class="control-label">Type: </label>
		<select id="type" style='width: 100px'> 
		<%= type %>
		</select>
	</td>
	<td><textarea class='form-control input-sm' id='details'><%= details %></textarea></td>
	<td><input type='text' value='<%= week %>' size='2' id='week' class='form-control input-sm'></td>
	<td><input type='text' value='<%= weight * 100 %>' size='3' id='weight' class='form-control input-sm'>%</td>
	<td><select multiple id="learning_outcomes" class='form-control input-sm'><%= learning_outcomes %></select></td>
	<td><a href="#criteria/<%= course_id %>/<%= id %>"><button type="button" class="btn btn-primary" id="rubric">Rubric</button></a></td>
</script>
<script id="assessmentWeekDefault" type="text/template">
	<input type='text' value='<%= week %>' size='2' id='week' class='form-control input-sm'>
</script>
<script id="assessmentWeekAlt" type="text/template">

 <div class="form-inline row">
	<div class='form-group form-group-sm'>
	<label for='week1' class='control-label' style='font-size: 12px'>Range:</label>
	<input type='radio' value='<%= week %>' id='week_type<%= id %>_1' name='week_radio<%= id %>' class='form-control input-sm' value='1' <%= radio1 %>>
	<input type='text' value='<%= week %>' size='2' id='week1' class='form-control input-sm'>  &ndash;  <input type='text' value='<%= week %>' size='2' id='week2' class='form-control input-sm'>
	<label for='week2' class='control-label'  style='font-size: 12px'>Ongoing:</label>&nbsp;&nbsp;
	<input type='radio' value='<%= week %>' id='week_type<%= id %>_2' name='week_radio<%= id %>' class='form-control input-sm' value='2' <%= radio2 %>>
	</div>
</div>
</script>

<script id="criterionRow" type="text/template">
	<td><button type="button" class="btn btn-xs btn-danger" id="delete" data-id="<%= id %>">-</button></td>
	<td><textarea class='form-control' id='description'><%= description %></textarea></td>
	<td><textarea class='form-control' id='col1'><%= col1 %></textarea></td>
	<td><textarea class='form-control' id='col2'><%= col2 %></textarea></td>
	<td><textarea class='form-control' id='col3'><%= col3 %></textarea></td>
	<td><textarea class='form-control' id='col4'><%= col4 %></textarea></td>
	<td><textarea class='form-control' id='col5'><%= col5 %></textarea></td>
</script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/course_mapping_tool/js/vendor/jquery-1.11.3.min.js"></script>
    <script src="/course_mapping_tool/js/vendor/bootstrap.min.js"></script>
    <script src="/course_mapping_tool/js/vendor/chosen.jquery.min.js"></script>
     <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/course_mapping_tool/js/vendor/ie10-viewport-bug-workaround.js"></script>
    <!--  <script src="/course_mapping_tool/js/vendor/select-duplicate.js"></script>  -->
	<script src="/course_mapping_tool/js/vendor/expandTextarea.js"></script>
	
    <script src="/course_mapping_tool/js/vendor/underscore-min.js"></script>
    <script src="/course_mapping_tool/js/vendor/backbone-min.js"></script>
    <script src="/course_mapping_tool/js/models/course.js"></script>
    <script src="/course_mapping_tool/js/models/assessment.js"></script>
    <script src="/course_mapping_tool/js/models/learningActivity.js"></script>
    <script src="/course_mapping_tool/js/models/learningOutcome.js"></script>
    <script src="/course_mapping_tool/js/models/criterion.js"></script>
    
    <script src="/course_mapping_tool/js/views/CourseMapperView.js"></script> <!-- view parent object -->
    <script src="/course_mapping_tool/js/views/addCourseView.js"></script>
    <script src="/course_mapping_tool/js/views/courseListView.js"></script>
    <script src="/course_mapping_tool/js/views/courseRow.js"></script>
    <script src="/course_mapping_tool/js/views/learningOutcomesView.js"></script>
    <script src="/course_mapping_tool/js/views/learningOutcomeRow.js"></script> 
    <script src="/course_mapping_tool/js/views/learningOutcomesTable.js"></script> 
    <script src="/course_mapping_tool/js/views/learningActivitiesView.js"></script>
    <script src="/course_mapping_tool/js/views/learningActivityRow.js"></script> 
    <script src="/course_mapping_tool/js/views/learningActivitiesTable.js"></script> 
    <script src="/course_mapping_tool/js/views/assessmentsView.js"></script>
    <script src="/course_mapping_tool/js/views/assessmentRow.js"></script> 
    <script src="/course_mapping_tool/js/views/criteriaTable.js"></script> 
    <script src="/course_mapping_tool/js/views/criteriaView.js"></script>
    <script src="/course_mapping_tool/js/views/criterionRow.js"></script> 
    <script src="/course_mapping_tool/js/views/assessmentsTable.js"></script> 
      <script src="/course_mapping_tool/js/views/summaryTable.js"></script> 
    <script src="/course_mapping_tool/js/views/summaryView.js"></script>
    <!--   <script src="/course_mapping_tool/js/views/summaryRow.js"></script>  -->
    <script src="/course_mapping_tool/js/collections/courses.js"></script>
    <script src="/course_mapping_tool/js/collections/learningOutcomes.js"></script>
    <script src="/course_mapping_tool/js/collections/learningActivities.js"></script>
    <script src="/course_mapping_tool/js/collections/assessments.js"></script>
    <script src="/course_mapping_tool/js/collections/criteria.js"></script>
    <script src="/course_mapping_tool/js/routes/router.js"></script>
    <script>
    	<?php 
    			$course_coll = array();
    	
    			$servername = "localhost";
    			$username = "root";
    			$password = "u0nb0ld";				
    			$db_name = "course_mapper";
    			
    			// Create connection
    			$conn = new mysqli($servername, $username, $password, $db_name);
    			// Check connection
    			if ($conn->connect_error) {
    			    die("Connection failed: " . $conn->connect_error);
    			} 

    			$sql = "SELECT * FROM courses LIMIT 0,100";
    			$result = $conn->query($sql);

    			if ($result->num_rows > 0) {
    				while($row = $result->fetch_assoc()) {
    			   		$course_coll[] = $row;
    				}
    			} 
    			$conn->close();
    			
    			$courses = json_encode($course_coll);
    	?>
    	
    var courseListCollection = new app.courses(<?= $courses ?>);
	var homeListView = new app.courseListView({ collection: courseListCollection });		
	
	var header = "<thead>\
					  <tr>\
					    <th>Course Name</th>\
					    <th>Course Code</th>\
					    <th>Course Duration (wks)</th>\
					  </tr>\
				</thead>";
	
	$("#courses").html(header).append(homeListView.render().el);
    </script>
    <script src="/course_mapping_tool/js/CourseMapperApp.js"></script>
   

  </body>
</html>
