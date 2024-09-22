"use strict";

let table = document.querySelector("table");
let largestPuddl = document.querySelector(".largestPuddl");
let puddleCount = document.querySelector(".puddleCount");
let button = document.querySelector("button");

button.addEventListener('click', function(){
    table.innerHTML = '';
    let promis = fetch('dazzler.php');

    promis.then(
        response => {
            return response.json();
        }
    ).then(
        data => {
            for(let i=0; i<data.length -1; i++){
                let row = document.createElement('tr');
                for(let elem of data[i]){
                    let cell = document.createElement('td');
                    if(elem){
                        cell.classList.add('painted');
                    }
                    row.append(cell);
                }
                table.append(row);
            }
            largestPuddl.innerHTML = data[data.length-1][0];
            puddleCount.innerHTML = data[data.length-1][1];
        }
    )
})
