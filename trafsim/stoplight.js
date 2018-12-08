/*
	stoplight.js
	Stopligh object for simple single lane traffic flow
	simulation with agent-based model
	
	Sparisoma Viridi | dudung@gmail.compile
	
	20181030
	Create this library with constructor, state, ping,
	attachToLaneAt, detachFromLane.
	All are tested and ok at 1536.
*/

// Define class of Stoplight
class Stoplight {
	constructor() {
		this.pos = 0;
		this.lane = -1;
		this.sequence = [];
		if(arguments.length < 1) {
			throw new Error("Sequence of Stoplight must be "
				+ "provided as argument!");
		} else {
			this.sequence = arguments[0];
		}
	}
	
	state() {
		return this.sequence[this.pos];
	}
	
	ping() {
		this.pos++;
		if(this.pos >= this.sequence.length) {
			this.pos = 0;
		}
		arguments[0][this.lane].cell[this.lanePos] = -this.state();
	}
	
	attachToLaneAt() {
		this.lane = arguments[0];
		this.lanePos = arguments[1];
	}
	
	detachFromLane() {
		this.lane = -1;
		delete(this.lanePos);
	}
}
