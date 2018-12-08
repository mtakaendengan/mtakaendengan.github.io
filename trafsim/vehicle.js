/*
	vehicle.js
	Vehicle object for simple single lane traffic flow
	simulation with agent-based model
	
	Sparisoma Viridi | dudung@gmail.compile
	
	20181030
	Create this library with constructor, ping, addToLane.
	20181031
	Repair attachToLaneAt and create attachToLanesAt.
*/

// Define class of Stoplight
class Vehicle {
	constructor() {
		this.vel = 1;
		if(arguments.length < 1) {
			throw new Error("Velocity of Vehicle must be "
				+ "provided as argument!");
		} else {
			this.vel = arguments[0];
		}
		this.min = 0;
		this.max = 0;
		this.pos = 0;
		this.lane = -1;
	}
	
	ping() {
		var oldpos = this.pos;
		var newpos = oldpos;
		
		this.max = arguments[0][this.lane].cell.length;
		newpos++;
		if(newpos >= this.max) {
			newpos = this.min;
		}
		
		if(arguments[0][this.lane].cell[newpos] == 0) {
			arguments[0][this.lane].cell[oldpos] = 0;
			arguments[0][this.lane].cell[newpos] = 1;
			this.pos = newpos;
		}
	}
	
	attachToLaneAt() {
		this.lane = arguments[0];
		this.lanePos = arguments[1];
		this.min = 0;
	}
	
	attachToLanesAt() {
		this.lane = arguments[1];
		this.lanePos = arguments[2];
		arguments[0][this.lane].cell[this.lanePos] = 1;
		this.pos = this.lanePos;
		this.min = 0;
	}
	
	detachFromLane() {
		this.min = 0;
		this.max = 0;
		this.lane = -1;
		delete(this.lanePos);
	}
}
