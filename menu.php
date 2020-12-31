<html>
<head>
<style>
#topnav{
	display:block;
	float:right;
	width:650px;
	font-size:14px;
	font-family:Georgia, "Times New Roman", Times, serif;
	}

#topnav ul, #topnav li{
	margin:0;
	padding:0;
	list-style:none;
	}

#topnav li{
	float:right;
	margin-right:30px;
	}

#topnav li li{
	margin-right:0;
	}

#topnav li span{
	display:block;
	margin:5px 0 0 0;
	padding:0;
	font-size:12px;
	font-weight:bold;
	font-family:Arial, Helvetica, sans-serif;
	text-transform:lowercase;
	color:#999999;
	background-color:#000000;
	font-weight:normal;
	line-height:normal;
	}

#topnav li a:link, #topnav li a:visited, #topnav li a:hover{
	display:block;
	margin:0;
	padding:20px 0 0 0;
	color:#CCCCCC;
	background-color:#000000;
	text-transform:uppercase;
	border-top:2px solid #FFFFFF;
	font-weight:bold;
	}

#topnav ul ul li a:link, #topnav ul ul li a:visited{
	border:none;
	}

#topnav li a:hover, #topnav li.active a{
	color:#FFFF00;
	background-color:#000000;
	border-top-color:#FFFF00;
	}
	
#topnav li li a:link, #topnav li li a:visited{
	width:150px;
	float:none;
	margin:0;
	padding:7px 10px;
	font-size:12px;
	font-weight:normal;
	color:#CCCCCC;
	background-color:#242424;
	border:none;
	}
	
#topnav li li a:hover{
	color:#FFFF00;
	background-color:#999999;
	}

#topnav ul ul{
	z-index:9999;
	position:absolute;
	left:-999em;
	height:auto;
	width:170px;
	}

#topnav ul ul a{width:140px;}

#topnav li:hover ul{left:auto;}

#topnav li:hover{position:static;}

#topnav li.last{margin-right:0;}
</style>
</head>
<body id="top">
    <div class="wrapper col1">
      <div id="header">
        <div id="topnav">
          <ul>
            <li class="last active"><a href="gallery.html">Gallery Demo</a><span>Test Text Here</span></li>
            <li><a href="#">DropDown</a><span>Test Text Here</span>
              <ul>
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
              </ul>
            </li>
            <li><a href="full-width.html">Full Width</a><span>Test Text Here</span></li>
            <li><a href="style-demo.html">Style Demo</a><span>Test Text Here</span></li>
            <li><a href="index.html">Homepage</a><span>Test Text Here</span></li>
          </ul>
        </div>
        <div class="fl_left">
          <h1><a href="#">Gallerised</a></h1>
          <p>Free CSS Website Template</p>
        </div>
        <br class="clear" />
      </div>
    </div>
</html>