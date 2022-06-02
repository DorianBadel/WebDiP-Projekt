document.addEventListener("DOMContentLoaded", ucitajGraf);


function perspective(space,max,value){
  return space - (value/max * space);
}

function ucitajGraf(){
  let canv = document.getElementById("canvas");
  var cont = canv.getContext("2d");

  let TOP = 25;
  let LEFT = 55;

  let HEIGHT = canv.getAttribute('height')-110;
  let BOTTOM = HEIGHT+75;
  let WIDTH = canv.getAttribute('width')-100;
  let RIGHT = WIDTH+75;

  cont.clearRect(0,0,400,400);

  cont.beginPath();
  cont.moveTo(LEFT, TOP);
  cont.lineTo(LEFT,BOTTOM);
  cont.lineTo(RIGHT, BOTTOM);
  cont.stroke();

  let arr = [];
  var xml = new XMLHttpRequest();
  xml.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){

      let xmlFile = this.responseXML;
      let tmpArr = xmlFile.getElementsByTagName("pregledi");
      for(let i = 0; i< tmpArr.length; i++){
        arr.push(parseInt(tmpArr[i].childNodes[0].data));
      }
      console.log(arr);

      let max = 0;

      for(let i = 0; i< arr.length; i++){
        if(arr[i] > max) max = arr[i];
      }


      cont.font = "12px arial";


      cont.beginPath();
      cont.strokeStyle = "rgba(255,255,255,0.5)";
      cont.moveTo(LEFT, TOP);
      cont.lineTo(RIGHT, TOP);
      cont.stroke();

      for(let i = 0; i< arr.length; ++i){
        cont.beginPath();
        cont.moveTo(LEFT, perspective(HEIGHT,max,arr[i])+TOP);
        cont.lineTo(RIGHT, perspective(HEIGHT,max,arr[i])+TOP);
        cont.fillText(arr[i],10,(perspective(HEIGHT,max,arr[i])+30));
        cont.stroke();
      }

      cont.beginPath();
      cont.lineJoin = "round";
      cont.strokeStyle = "black";

      cont.moveTo(LEFT, (perspective(HEIGHT,max,arr[0]))+ TOP);

      for( let i = 0; i < arr.length; ++i ){
        cont.lineTo( RIGHT / arr.length * i + LEFT, (perspective(HEIGHT,max,arr[i])) + TOP );
        cont.fillText((i+1), RIGHT / arr.length * i + LEFT, BOTTOM + 20);
      }

      cont.stroke();

    }
  }
  xml.open("GET","script/auth_stat.php", true);
  xml.send();



}
