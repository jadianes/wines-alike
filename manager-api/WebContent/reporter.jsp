<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
<link rel="stylesheet" href="css/reporter.css">

<%@ page import="manager.ManagerConfig" %>
<%@ page import="manager.WAManagerFactory" %>
<%@ page import="manager.WAManager" %>
<%@ page import="reports.HTMLEntryFactory" %>
<%@ page import="reports.HTMLEntry" %>
<%@ page import="reports.UserHTMLEntry" %>
<%@ page import="java.sql.ResultSet" %>

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
            <% 		
    			WAManager manager = WAManagerFactory.getWAManager(    				
    					ManagerConfig.user, 
        				ManagerConfig.password, 
        				ManagerConfig.database, 
        				ManagerConfig.host,
        				"users");
            HTMLEntry entry = HTMLEntryFactory.getHTMLEntry("user");
    			ResultSet rs = manager.rs;
    			int i=0;
            while (rs.next()) 
            {       		
				if (i%3 == 0) { // end row and start new one
					%>
			</div>
			<hr>
			<div class="row">
					<%
				}%>
			<span class="span3 entry">
    				<%= entry.toHTML(rs)  %>
  			</span>
        		<%
        		i++;
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