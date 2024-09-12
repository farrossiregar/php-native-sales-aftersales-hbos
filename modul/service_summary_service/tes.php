<html>
<head>
<style>
html, body{
  margin:0;
  padding:0;
  height:100%;
}
section {
  position: relative;
  border: 1px solid #000;
  padding-top: 37px;
  background: #500;
}
section.positioned {
  position: absolute;
  top:100px;
  left:100px;
  width:800px;
  box-shadow: 0 0 15px #333;
}
.container {
  overflow-y: auto;
  height: 200px;
}
table {
  border-spacing: 0;
  width:100%;
}
td + td {
  border-left:1px solid #eee;
}
td, th {
  border-bottom:1px solid #eee;
  background: #ddd;
  color: #000;
  padding: 10px 25px;
}
th {
  height: 0;
  line-height: 0;
  padding-top: 0;
  padding-bottom: 0;
  color: transparent;
  border: none;
  white-space: nowrap;
}
th div{
  position: fixed;
  background: transparent;
  color: #fff;
  padding: 9px 25px;
  top: 0;
  margin-left: -25px;
  line-height: normal;
  border-left: 1px solid #800;
}
th:first-child div{
  border: none;
}
</style>
</head>
<body>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
  <div class="container">
    <table>
      <thead>
        <tr class="">
          <th>
            Table attribute name
            <div>Table attribute name</div>
          </th>
          <th>
            Value
            <div>Value</div>
          </th>
          <th>
            Description
            <div>Description</div>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>align</td>
          <td>left, center, right</td>
          <td>Not supported in HTML5. Deprecated in HTML 4.01. Specifies the alignment of a table according to surrounding text</td>
        </tr>
        <tr>
          <td>bgcolor</td>
          <td>rgb(x,x,x), #xxxxxx, colorname</td>
          <td>Not supported in HTML5. Deprecated in HTML 4.01. Specifies the background color for a table</td>
        </tr>
        <tr>
          <td>border</td>
          <td>1,""</td>
          <td>Specifies whether the table cells should have borders or not</td>
        </tr>
        <tr>
          <td>cellpadding</td>
          <td>pixels</td>
          <td>Not supported in HTML5. Specifies the space between the cell wall and the cell content</td>
        </tr>
        <tr>
          <td>cellspacing</td>
          <td>pixels</td>
          <td>Not supported in HTML5. Specifies the space between cells</td>
        </tr>
        <tr>
          <td>frame</td>
          <td>void, above, below, hsides, lhs, rhs, vsides, box, border</td>
          <td>Not supported in HTML5. Specifies which parts of the outside borders that should be visible</td>
        </tr>
        <tr>
          <td>rules</td>
          <td>none, groups, rows, cols, all</td>
          <td>Not supported in HTML5. Specifies which parts of the inside borders that should be visible</td>
        </tr>
        <tr>
          <td>summary</td>
          <td>text</td>
          <td>Not supported in HTML5. Specifies a summary of the content of a table</td>
        </tr>
        <tr>
          <td>width</td>
          <td>pixels, %</td>
          <td>Not supported in HTML5. Specifies the width of a table</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>