<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
<link rel="stylesheet" href="css/reporter.css">

<title>WinesAlike Reporter tool</title>

</head>
<body>

    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#">WinesAlike Reporter</a>
          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#help">Help</a></li>
          </ul>
          <form action="" class="pull-right">
            <input class="input-small" type="text" placeholder="Username">
            <input class="input-small" type="password" placeholder="Password">
            <button class="btn" type="submit">Sign in</button>
          </form>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="content">
        <div class="page-header">
          <h1>Wellcome, admin <small><%= new java.util.Date()  %></small></h1>
        </div>
        <div class="row">
          <div class="span10">
            <h2>Latest entries</h2>
            <div class="row">
            <% for ( int i = 0; i < 10; i++ ) 
            {       		
				if (i%3 == 0) { // end row and start new one
					%>
			</div>
			<hr>
			<div class="row">
					<%
				}%>
			<span class="span3 entry">
    				<h4>Entry</h4>
    				<p><%= i+1 %></p>
  			</span>
        		<%
    			}%>
    			</div>
          </div> <!-- Span 10  -->
          
          <div class="span3">
            <h3>Choose table</h3>
          </div>
        </div> <!-- row -->
      </div> <!-- content -->

      <footer>
        <p>&copy; WinesAlike 2011</p>
      </footer>

    </div> <!-- /container -->

</body>
</html>