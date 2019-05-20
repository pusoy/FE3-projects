<html>
<head>
  <title></title>
  <script type="text/javascript">

nice = (function (document, window, nice) {   
  var node = Node.prototype,
      nodeList = NodeList.prototype,
      forEach = 'forEach',
      trigger = 'trigger',
      each = [][forEach], 
      dummy = document.createElement('i');

  nodeList[forEach] = each;
 
  window.on = node.on = function (event, fn) {
    this.addEventListener(event, fn, false);
 
    return this;
  };

  nodeList.on = function (event, fn) {
    this[forEach](function (el) {
      el.on(event, fn);
    });
    return this;
  };
 
  window[trigger] = node[trigger] = function (type, data) { 
    var event = document.createEvent('HTMLEvents');
    event.initEvent(type, true, true);
    event.data = data || {};
    event.eventName = type;
    event.target = this;
    this.dispatchEvent(event);
    return this;
  };

  nodeList[trigger] = function (event) {
    this[forEach](function (el) {
      el[trigger](event);
    });
    return this;
  };

  nice = function (s) { 
    var r = document.querySelectorAll(s || '?'),
        length = r.length; 
    return length == 1 ? r[0] : r;
  };
 
  nice.on = node.on.bind(dummy);
  nice[trigger] = node[trigger].bind(dummy);

  return nice;
})(document, this);
</script>
</head>
<body>
<div id="hello"> 
<div id="container">
  siblings:<br>
  <input class="siblings" placeholder="Sibling 1"/><br>
  <input class="siblings" placeholder="Sibling 2"/><br>
  <input class="siblings" placeholder="Sibling 3"/><br/> 
    </div>
    <div id="container1">
      <input id="plus" type="button" value="+">
    <input id="ok"   type="button" value="ok">
    </div> 
<script type="text/javascript">
   

  nice("#plus").addEventListener("click",function(){

    var container=nice('#container');
    var siblings= nice('.siblings');
    var count = siblings.length+1;
    var newNode = document.createElement("input"); 
    newNode.classList.add("siblings");
    newNode.placeholder = "siblings" + count;

    container.appendChild(newNode);

  });
 
//   nice("#ok").addEventListener("click",function(){
// var siblings = nice('.siblings');
//     var wew=0;
//     var res="";
//     var data="{";
//     while(siblings.length>wew){
//       data+= "'Siblings #" + (wew+1) +"':"+siblings[wew].value+", ";
//       wew++; 
//     }
//  data+="}";  
//  var po= data.slice(0,-3)+"}"
        
//  var hello={po};
//        console.log(hello);
//           }
//           )
 
 
  </script> 
</body>
</html>
 <script type="text/javascript"> 
  var btn = nice("#ok");
  btn.onclick = function(){
  var req = new XMLHttpRequest();
    var siblings= nice('.siblings');
     var wew=0;
    var res="";
    var data="{";
    while(siblings.length>wew){
      data+= '"Siblings #'+ (wew+1) +'": "'+siblings[wew].value+'",';
      wew++; 
    }
 data+="}";  
 var po= data.slice(0,-2)+"}"
// gh=JSON.parse(po);
// var myJSON = JSON.stringify(po);
 //var data={po};
  req.onreadystatechange = function() {
  if(req.readyState == XMLHttpRequest.DONE){
    var wew = JSON.parse(req.responseText); 

      // var new1p= new array('Siblings'=>wew);
      // var ll= wew.Siblings;
      // var yu=JSON.stringify(ll);
       var ee = JSON.parse(wew.Siblings);
          console.log(ee);
         // console.log(wew.Siblings);
//          console.log("Siblings{\n"+ee+"\n}");
        //alert(ll);
   //console.log(ll.slice.join('\r\n'))
//console.log(Array.prototype.slice.call(ll).join('\n'));
      //var mop=(JSON.parse(wew.Siblings));
  }
};
req.open("POST", "poi2.php", true);
req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
req.send('siblings='+po);
}
</script>
