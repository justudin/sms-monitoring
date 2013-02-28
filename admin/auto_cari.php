<html>
<head>
   <title>SMS Auto Forwarding</title>
   <script type="text/javascript">

  function ajax()
  {
  if (window.XMLHttpRequest)
  {
     xmlhttp=new XMLHttpRequest();
  }
  else
  {
     xmlhttp =new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.open("GET","cari.php");
  xmlhttp.send();
  setTimeout("ajax()", 5000);
  }
  </script>

</head>

<body onload="ajax()">
      <h1>SMS Auto Forwarding running...</h1>
</body>
</html>