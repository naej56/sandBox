var QUOTATIONCREATION = QUOTATIONCREATION || {};

QUOTATIONCREATION.tableAddRow = {
	test: "Quotation",
	addRow: function(table){
		var newLine;

		newLine = document.getElementById(table);
		newCell = newLine.inssertCell(0);
	}

}

QUOTATIONCREATION.tableAddRow.addRow;

/*function Table(id){
	this.table = document.getElementById(id),
	this.table.addLine: function() {
		var newLine, newCell;

		newLine = this.insertRow(this.rows.length);
		newCell = newLine.inssertCell(0);
	}
}*/


/*Table.prototype.addLine = function(){
	var newLine, newCell;
	
	newLine = this.insertRow(this.rows.length); // add row to the table
	console.log(newLine);
	newCell = newLine.inssertCell(0); // add cell to the new row
	newCell.innerHTML = 'cellule 0';
}*/

//var quotation = new Table('Quotation');

//console.log(quotation.table.rows.length);

//quotation.addLine;