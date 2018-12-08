/*
	test.js
	Test some functions
	
	Sparisoma Viridi | dudung@gmail.compile
	
	20181030
	Start this library.
	20181031
	Continue adding experimental codes.
*/

// 20181030.0754
function test_xx() {
/*
	Algorithm
	01 Define vehicles with id and speed
	02 Define Stoplight state in a Lane as -1

	10 Advance time
	11 Ping all Stoplight objects
	12 Ping all Lane objects
	13 Ping all Vehicle objects in a Lane object
	14 Move Vehicle according to defined rule
	15 Repeat Step 10 if final time has not been reached
*/

/*
	20181030.1015
	In a lane there are cells with only two states
	0: empty or allowed to be occupied
	1: not allowed to be occupied, since it is
	   filled with vehicle or stoplight is on
	
*/
}

// 20181031.0052
function test_05() {
	// Define examples of coordinates
	var x1 = [
		02, 02, 02, 03, 04, 05, 05, 05, 05, 05,
		05, 06, 07, 08, 09, 10, 11, 12, 13, 14,
		15, 16, 16, 16, 16, 16, 16, 16, 16, 16
	];
	var y1 = [
		03, 04, 05, 05, 05, 05, 06, 07, 08, 09,
		10, 10, 10, 10, 10, 10, 10, 10, 10, 10,
		10, 10, 11, 12, 13, 14, 15, 16, 17, 18
	];
	var x2 = [
		16, 16, 16, 15, 14, 13, 12, 11, 10, 10,
		10, 10, 10, 10, 10, 10, 10, 10, 10, 10,
		10, 09, 08, 07, 06, 05, 04, 03, 03, 03
	];
	var y2 = [
		02, 03, 04, 04, 04, 04, 04, 04, 04, 05,
		06, 07, 08, 09, 10, 11, 12, 13, 14, 15,
		16, 16, 16, 16, 16, 16, 16, 16, 17, 18
	];
	var x3 = [
		00, 10, 20, 20, 20, 10, 00, 00
	];
	var y3 = [
		00, 00, 00, 10, 20, 20, 20, 10
	];
	
	// Create two lanes and put them into array of lanes
	var lane1 = new Lane(x1, y1);
	lanes.push(lane1);
	var lane2 = new Lane(x2, y2);
	lanes.push(lane2);
	
	/*
	var lane3 = new Lane(x3, y3);
	lanes.push(lane3);
	*/
	
	// Define examples of sequences (traffic ligh plans)
	var seq1 = [0, 0, 0, 0, 0, 1, 1, 1, 1, 1];
	var seq2 = [1, 1, 1, 1, 1, 0, 0, 0, 0, 0];
	/*
	var seq3 = [0, 0, 0, 0, 1, 1, 1, 1];
	*/
	
	// Create two stoplights and put them to array of stoplights
	var stoplight1 = new Stoplight(seq1);
	stoplight1.attachToLaneAt(0, 14);
	stoplights.push(stoplight1);
	var stoplight2 = new Stoplight(seq2);
	stoplight2.attachToLaneAt(1, 13);
	stoplights.push(stoplight2);
	/*
	var stoplight3 = new Stoplight(seq3);
	stoplight3.attachToLaneAt(2, 4);
	stoplights.push(stoplight3);
	*/
	
	// Define examples of vehicles
	var vehicle1 = new Vehicle(4);
	vehicle1.attachToLaneAt(0, 5);
	vehicles.push(vehicle1);
	var vehicle2 = new Vehicle(1);
	vehicle2.attachToLaneAt(0, 0);
	vehicles.push(vehicle2);
	var vehicle3 = new Vehicle(2);
	vehicle3.attachToLaneAt(1, 4);
	vehicles.push(vehicle3);
	var vehicle4 = new Vehicle(2);
	vehicle4.attachToLaneAt(1, 1);
	vehicles.push(vehicle4);
	var vehicle5 = new Vehicle(1);
	vehicle5.attachToLaneAt(1, 0);
	vehicles.push(vehicle5);
}

// 20181030.1927
function test_04() {
	cx.fillStyle = "#f00";
	cx.clearRect(0, 0, 200, 200);
	cx.beginPath();
	cx.arc(100 + 5 * iter, 100, 20, 0, 1);
	cx.stroke();
}

// 20181030.0847 !ok
function test_03() {
	var veh = new Vehicle(1);
	const object = {1: "a", 100: "b", 20: "c"};
	for(var x in object) {
		console.log(Object.entries(object)[x]);
	}
}

// 20181030.0603 ok
function test_02() {
	var L1 = new Lane();
	L1.addX([1, 2, 3, 4, 5]);
	L1.addY([1, 2, 3, 4, 5]);
	return L1;
}

// 20181030.0558 ok
function test_01() {
	var L1 = new Lane();
	console.log(L1.length);
	L1.addX([1, 1, 3, 4, 5]);
	console.log(L1.length);
	L1.addY([0, 1, 1, 3, 4, 5]);
	console.log(L1.length);
}

// 20181030.0552 ok
function test_00() {
	var S1 = new Stoplight([0, 1, 0, 0, 1, 1]);
	for(var i = 0; i < 12; i++) {
		console.log(S1.pos, S1.state());
		S1.ping();
	}
}
