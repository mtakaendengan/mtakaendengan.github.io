/*
	lane.js
	Lane object for simple single lane traffic flow
	simulation with agent-based model
	
	Sparisoma Viridi | dudung@gmail.compile
	
	20181030
	Create this library with constructor, addCoordinates.
*/

// Define class of Lane
class Lane {
	constructor() {
		this.cell = [];
		this.x = [];
		this.y = [];
		this.length = 0;
		
		if(arguments.length != 2) {
			throw new Error("Coordinates x[] and y[] must be " +
				"provided as arguments!");
		} else {
			this.addCoordinates(arguments[0], arguments[1]);
		}
	}
	
	addCoordinates() {
		this.x = arguments[0];
		this.y = arguments[1];
		this.length = this.x.length;
		var lx = this.x.length;
		var ly = this.y.length;
		this.length = (lx < ly) ? lx : ly;
		this.cell.length = this.length;
		this.cell.fill(0);
	}
}
