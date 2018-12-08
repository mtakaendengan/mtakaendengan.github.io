/*
	main.js
	Main program of simple single lane traffic flow
	simulation with agent-based model

	Modified by:
	Mahardika Takaendengan 	| mahardika.takaendengan@gmail.com
	Melyana Dwitasari				| melyanadwitasari@gmail.com

	Based on:
	Sparisoma Viridi 				| dudung@gmail.com

	- 20181030
	- 20180712
	Start this program.
*/

// Define some global variables
var ta, btn, can;
var timer;
var period, iter;
var lanes = [];
var stoplights = [];
var vehicles = [];
var caseNumber;

// Define main function
function main() {
	layout();

	caseNumber = 0;
	init();
	//console.log(lanes);
	//drawLanes(lanes);
}

// Initialize parameters
function init() {
	// Define parameters for iteration
	period = 500;
	iter = 0;

	switch(caseNumber) {
		case 0: initCase0(); break; // 2 Intersections
		case 1: initCase1(); break;	// Real-World Problem #1
		case 2: initCase2(); break;
		case 3: initCase3(); break;
		case 4: initCase4(); break;
		case 5: initCase5(); break;
	}
}

// Define case Tesis 1
function initCase0(){
	// Define examples of coordinates
	var x1 = [
		01, 02, 03, 04, 05, 06, 07, 08, 09, 10,
		11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
		21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
	];
	var y1 = [
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
	];

	var x2 = [
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
	];
	var y2 = [
		30, 29, 28, 27, 26, 25, 24, 23, 22, 21,
		20, 19, 18, 17, 16, 15, 14, 13, 12, 11,
		10, 09, 08, 07, 06, 05, 04, 03, 02, 01,
	];

	// Create two lanes and put them into array of lanes
	var lane1 = new Lane(x1, y1); lanes.push(lane1);
	var lane2 = new Lane(x2, y2); lanes.push(lane2);

	// Define examples of sequences (traffic ligh plans)
	var seq1 = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
	var seq2 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1];

	// Create stoplights and put them to array of stoplights
	var stoplight1 = new Stoplight(seq1);
	stoplight1.attachToLaneAt(0, 13);
	stoplights.push(stoplight1);
	var stoplight2 = new Stoplight(seq2);
	stoplight2.attachToLaneAt(1, 14);
	stoplights.push(stoplight2);

	// Define examples of vehicles
	var Nlane = lanes.length;
	var Nvpl = 10;
	var maxV = 5;
	for(var i = 0; i < Nlane; i++) {
		for(var j = 0; j < Nvpl; j++) {
			var v = randInt(1, maxV);
			var vehicle = new Vehicle(v);
			vehicle.attachToLanesAt(lanes, i, j);
			vehicles.push(vehicle);
			//lanes[i].cell[j] = 1;
		}
	}
}


// Define case 1
function initCase1(){
	// Define examples of coordinates

	// Jalan Aceh Barat-Aceh Timur
	var x1 = [
		01, 02, 03, 04, 05, 06, 07, 08, 09, 10,
		11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
		21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
	];
	var y1 = [
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
	];

	// Jalan Merdeka Utara-Merdeka Selatan
	var x2 = [
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
		15, 15, 15, 15, 15, 15, 15, 15, 15, 15,
	];
	var y2 = [
		30, 29, 28, 27, 26, 25, 24, 23, 22, 21,
		20, 19, 18, 17, 16, 15, 14, 13, 12, 11,
		10, 09, 08, 07, 06, 05, 04, 03, 02, 01,
	];

	// Jalan Aceh Barat-Merdeka Selatan
	var x3 = [
		01, 02, 03, 04, 05, 06, 07, 08, 09, 10,
		11, 12, 13,
		14, 14, 14, 14, 14, 14, 14, 14, 14, 14,
		14, 14, 14, 14,
	];
	var y3 = [
		14, 14, 14, 14, 14, 14, 14, 14, 14, 14,
		14, 14, 14,
		14, 13, 12, 11, 10, 09, 08, 07, 06, 05,
		04, 03, 02, 01,
	];

	// Jalan Merdeka Utara#2-Merdeka Selatan#2
	var x4 = [
		16, 16, 16, 16, 16, 16, 16, 16, 16, 16,
		16, 16, 16, 16, 16, 16, 16, 16, 16, 16,
		16, 16, 16, 16, 16, 16, 16, 16, 16, 16,
	];
	var y4 = [
		30, 29, 28, 27, 26, 25, 24, 23, 22, 21,
		20, 19, 18, 17, 16, 15, 14, 13, 12, 11,
		10, 09, 08, 07, 06, 05, 04, 03, 02, 01,
	];

	// Jalan Merdeka Utara#3-Merdeka Selatan#3
	var x5 = [
		17, 17, 17, 17, 17, 17, 17, 17, 17, 17,
		17, 17, 17, 17, 17, 17, 17, 17, 17, 17,
		17, 17, 17, 17, 17, 17, 17, 17, 17, 17,
	];
	var y5 = [
		30, 29, 28, 27, 26, 25, 24, 23, 22, 21,
		20, 19, 18, 17, 16, 15, 14, 13, 12, 11,
		10, 09, 08, 07, 06, 05, 04, 03, 02, 01,
	];

	// Jalan Merdeka Utara-Aceh Timur
	var x6 = [
		18, 18, 18, 18, 18, 18, 18, 18, 18, 18,
		18, 18, 18, 18,
		18, 19, 20, 21, 22, 23, 24,
		25, 26, 27, 28, 29, 30,
	];
	var y6 = [
		30, 29, 28, 27, 26, 25, 24, 23, 22, 21,
		20, 19, 18, 17, 16,
		16, 16, 16, 16, 16, 16, 16, 16, 16, 16,
		16, 16, 16, 16,
	];

	// Jalan Aceh Timur-Merdeka Selatan
	var x7 = [
		30, 29, 28, 27, 26, 25, 24, 23, 22, 21,
		20, 19, 18,
		18, 18, 18, 18, 18, 18, 18, 18, 18, 18,
		18, 18, 18, 18,
	];
	var y7 = [
		14, 14, 14, 14, 14, 14, 14, 14, 14, 14,
		14, 14, 14,
	 	13, 12, 11, 10, 09, 08, 07, 06, 05, 04,
		03, 02, 01,
	];

	// Create two lanes and put them into array of lanes
	var lane1 = new Lane(x1, y1); lanes.push(lane1);
	var lane2 = new Lane(x2, y2); lanes.push(lane2);
	var lane3 = new Lane(x3, y3); lanes.push(lane3);
	var lane4 = new Lane(x4, y4); lanes.push(lane4);
	var lane5 = new Lane(x5, y5); lanes.push(lane5);
	var lane6 = new Lane(x6, y6); lanes.push(lane6);
	var lane7 = new Lane(x7, y7); lanes.push(lane7);

	// Define examples of sequences (traffic light plans)
	var seq1 = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
	var seq2 = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1];

	// Create stoplights and put them to array of stoplights
	var stoplight1 = new Stoplight(seq1);
	stoplight1.attachToLaneAt(0, 12);
	stoplights.push(stoplight1);
	var stoplight2 = new Stoplight(seq2);
	stoplight2.attachToLaneAt(1, 13);
	stoplights.push(stoplight2);
	var stoplight2 = new Stoplight(seq2);
	stoplight2.attachToLaneAt(3, 13);
	stoplights.push(stoplight2);
	var stoplight2 = new Stoplight(seq2);
	stoplight2.attachToLaneAt(4, 13);
	stoplights.push(stoplight2);

	// Define examples of vehicles
	var Nlane = lanes.length;
	var Nvpl = 7;
	var maxV = 5;
	for(var i = 0; i < Nlane; i++) {
		for(var j = 0; j < Nvpl; j++) {
			var v = randInt(1, maxV);
			var vehicle = new Vehicle(v);
			vehicle.attachToLanesAt(lanes, i, j);
			vehicles.push(vehicle);
			//lanes[i].cell[j] = 1;
		}
	}
}

// Define simulate function
function simulate() {
	drawLanes(lanes);
	var content = "Itteration (second):" + " " + iter + "\n";
	var N = lanes.length;
	for(var i = 0; i < N; i++) {
		var M = lanes[i].cell.length;
		var line = "";
		for(var j = 0; j < M; j++) {
			line += lanes[i].cell[j] + " ";
		}
		content += "L" + i + ": " + line + "\n";
	}
	ta.value = content;
	ta.scrollTop = ta.scrollHeight;

	var N = stoplights.length;
	for(var i = 0; i < N; i++) {
		stoplights[i].ping(lanes);
	}

	var N = vehicles.length;
	for(var i = 0; i < N; i++) {
		var M = vehicles[i].vel;
		for(var j = 0; j < M; j++) {
			vehicles[i].ping(lanes);
		}
	}

	iter++;
}

// Draw lanes
function drawLanes() {
	var cx = can.getContext("2d");
	var XMIN = 0;
	var XMAX = can.width;
	var YMIN = can.height;
	var YMAX = 0;
	var xmin = 0;
	var xmax = 32; //set (n)number of tiles + 2 for border
	var ymin = 0;
	var ymax = 32;

	var boxWidthX = (XMAX - XMIN) / (xmax - xmin);
	var boxWidthY = -(YMAX - YMIN) / (ymax - ymin);
	var boxWidth = Math.min(boxWidthX, boxWidthY);

	function tx(x) {
		var X = (x - xmin) / (xmax - xmin);
		X *= (XMAX - XMIN);
		X += XMIN;
		return X;
	}
	function ty(y) {
		var Y = (y - ymin) / (ymax - ymin);
		Y *= (YMAX - YMIN);
		Y += YMIN;
		return Y;
	}

	var M = arguments[0].length;
	for(var j = 0; j < M; j++) {
		var N = arguments[0][j].cell.length;
		for(var i = 0; i < N; i++) {
			var lane = arguments[0][j];
			var X = tx(lane.x[i]);
			var Y = ty(lane.y[i]);
			cx.beginPath();
			var fillStyle = "#fff";
			if(lane.cell[i] == 1) {
				fillStyle = "#000";
			} else if (lane.cell[i] == -1) {
				fillStyle = "#f00";
			}
			cx.fillStyle = fillStyle;
			cx.fillRect(X, Y, boxWidth, -boxWidth);
			cx.lineWidth = 0.5;
			cx.rect(X, Y, boxWidth, -boxWidth);
			cx.stroke();
		}
	}
}

// Define start-stop button
function btnClick() {
	var cap = event.target.innerHTML;
	if(cap == "Start") {
		timer = setInterval(simulate, period);
		cap = "Stop";
	} else {
		clearInterval(timer);
		cap = "Start";
	}
	event.target.innerHTML = cap;
}


// Define layout
function layout() {
	can = document.createElement("canvas");
	document.body.append(can);
	can.width = "500";
	can.height = "500";
	can.style.width = "500px";
	can.style.height = "500px";
	can.style.background = "#fff";
	can.style.border = "1px solid #aaa";

	btn = document.createElement("button");
	document.body.append(btn);
	btn.innerHTML = "Start";
	btn.addEventListener("click", btnClick)

	ta = document.createElement("textarea");
	document.body.append(ta);
	ta.style.width = "500px";
	ta.style.height = "140px";
	ta.align= "center";
}
