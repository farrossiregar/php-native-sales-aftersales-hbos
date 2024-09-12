<%@ Page Language="C#" AutoEventWireup="true" CodeFile="Default.aspx.cs" Inherits="_Default" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
</head>
<body>
    <form id="form1" runat="server">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="JsCode.js"></script>
    <div align="center">
        <canvas id="myCanvas" width="300" height="200"></canvas>
        <br /><br />
        <table><tr><td><button onclick="javascript:DrawPic();return false;">Draw Picture</button></td><td><button onclick="javascript:UploadPic();return false;">Upload Picture to Server</button></td></tr></table>
    </div>
    </form>
</body>
</html>