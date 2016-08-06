//select table
var quotation = document.getElementById('Quotation')
var footer = document.getElementById('footer')



// count line
function CountLine(table) {
	this.nbLine = table.rows.length
	return this.nbLine
}

// add line 
function AddLine(table){
	var lineId, newLine, newCell, lineNumber

	lineId = CountLine(table) //-1
	newLine = table.insertRow(lineId)
	newCell = newLine.insertCell(0)
	//newCell.innerHTML = '<button onclick="DellLine(quotation, ' + lineId + ')" type="button" class="btn btn-danger btn-xs"><strong><i class="fa fa-minus" aria-hidden="true"></i></strong></button>'
	newCell = newLine.insertCell(1)
	//newCell.innerHTML = '<p id="LineId"></p>'
	newCell = newLine.insertCell(2)
	newCell.innerHTML = 'Qte'
	newCell = newLine.insertCell(3)
	newCell.innerHTML = 'Prix Unit.'
	newCell = newLine.insertCell(4)
	newCell.innerHTML = 'tva'
	newCell = newLine.insertCell(5)
	newCell.innerHTML = 'PV tot TTC'
	UpdateLineNumber(table)
}

// dell line
function DellLine(table, id){
	var lineId, lineNumber

	table.deleteRow(id)
	UpdateLineNumber(table)
}

// update l'id and # line
function UpdateLineNumber(table){
	var lineNumber, nbLine, cell

	nbLine = CountLine(table) //- 1
	for (var i = 0; i < nbLine; i++) {
		lineNumber = table.rowIndex
		table.rows[i].cells[0].innerHTML = '<button onclick="DellLine(quotation, ' + i + ')" type="button" class="btn btn-danger btn-xs">\
												<strong><i class="fa fa-minus" aria-hidden="true"></i></strong>\
											</button>\
											<span class="btn btn-primary btn-xs pull-right">' + (i + 1) + '</span>'
		table.rows[i].cells[1].innerHTML = '<input type="text" class="form-control" placeholder="Produit" id="InputText">'
		UpdateTotal(table)
	}
}

// update total
function UpdateTotal(table){
	var nbLine, total = 0

	nbLine = CountLine(table) //- 1
	for (var i = 0; i < nbLine; i++) {
		var temp = table.rows[i].cells[2].textContent
		total = parseFloat(total) + parseFloat(temp)
	}
	footer.innerHTML = total
}

