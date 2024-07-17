// // adding new boxsquerySelector

// //funtionc to remove the image
// let counter = 0
// const btn = document.getElementById("addgoal");
// btn.addEventListener("click", adde);
// btn.addEventListener("click", createnewBox);



//   document.addEventListener('DOMContentLoaded', function () {

//     const addBoxBtn = document.getElementById('addgoal');

//     addBoxBtn.addEventListener('click', function () {
//         // Remove the image when the button is clicked
//         const goalImage = document.getElementById('goalpng');
//         if (goalImage) {
//             goalImage.parentNode.removeChild(goalImage);
//         }
//     });
// });



// //function to add new save amount
// let pluses = document.querySelectorAll('.plus-sign');
// const plusEventListener = () => {
//     pluses.forEach(plus => {
//         plus.addEventListener("click", function () {
//             const id = parseInt(plus.id.split('-')[1]);
//             const tamount = parseInt(document.getElementById("totalAmount-" + id).textContent);
//             const progressValue = document.querySelector(".progress-value-" + id).textContent;
//             const samount = tamount * (parseInt(progressValue) / 100);
//             // console.log(samount);
//             // console.log(tamount);
//             // console.log(progressValue);
//             let newSaveAmount = samount + parseInt(prompt("Enter the amount you want to add", "0"));
//             if (isNaN(newSaveAmount)) {
//                 newSaveAmount = samount;
//                 alert("Please enter a valid number");
//             }
//             if (newSaveAmount > tamount) {
//                 alert("You have already achieved your goal");
//                 return;
//             }

//             console.log(newSaveAmount);
//             if (newSaveAmount > tamount) {
//                 alert("You have already achieved your goal");
//                 return;
//             }
//             fill(id, newSaveAmount, tamount);

//         });
//     });
// }


// //function to fill progress bar
// function fill(cnt, samount, tamount = 0) {  



//     if (tamount === 0) {
//         tamount = document.getElementById('sgoalamount').value;
//     }

//     // const samount = document.getElementById('samount').value;
//     // alert(samount);
//     const progress = document.querySelector(".progress-done-" + cnt);
//     const progressValue = document.querySelector(".progress-value-" + cnt);
//     let finalvalue = parseInt(samount, 10) || 0;
//     let max = parseInt(tamount, 10) || 1;

//     function changeWidth() {
        
//         progress.style.width = `${(finalvalue / max) * 100}%`;
//         progressValue.innerHTML = `${Math.ceil((finalvalue / max) * 100)}%`;
//     }

//     // Call changeWidth() initially to set the progress bar based on the initial values
//     changeWidth();
// }


// // function to create new boxes
// function createnewBox() {

//     const newDiv = document.createElement("div");
//     document.body.appendChild(newDiv);
// }


// document.addEventListener('DOMContentLoaded', function () {

  


//     const addBoxBtn = document.getElementById('addgoal');
//     const insightsSection = document.querySelector('.insights');

//     addBoxBtn.addEventListener('click', function () {
//         counter++;
//         const gname = document.getElementById('name').value;
//         const tamount = document.getElementById('sgoalamount').value;
//         const samount = document.getElementById('samount').value;

      
//         if (parseInt(samount) > parseInt(tamount)) {
//             alert("You have already achieved your goal");
//             return;
//         }


//         const newSalesBox = document.createElement('div');
//         newSalesBox.classList.add('sales');


//         newSalesBox.innerHTML = `
//             <span class="material-symbols-sharp">trending_up</span>
//             <div class="middle">
//                 <div class="left"> 
                
//                 <h3>${gname}</h3>  
//                 <h1 id="totalAmount-${counter}">₹${tamount}</h1>
                    
//                 </div>
//                 <div class="progress">
//                 <div>   
//                     <div class="progress">
//                         <div class= "progress-done progress-done-${counter}"></div>
//                         <div class="progress-value progress-value-${counter}">0%</div> <!-- Added this line -->
//                     </div>
//                 </div>
                
//                 <div class="plus-sign" id="addBox-${counter}">
//                     <span class="material-symbols-sharp">add</span>
//                 </div>
//             </div>
//             <small>ADD SAVED AMOUNT</small>
//         `;

//         insightsSection.appendChild(newSalesBox);
//         // const samount = document.getElementById('samount').value;
//         fill(counter, samount);
//         pluses = document.querySelectorAll('#addBox-' + counter);
//         // console.log(pluses);
//         plusEventListener();
//     });
// });



// //function to populate the table
// function adde() {
  
//     const gname = document.getElementById('name').value;
//     // const category= document.getElementById('category').value;
//     const tamount = document.getElementById('sgoalamount').value;
//     const note = document.getElementById('sgoalnote').value;
//     const tdate = document.getElementById('Targetdate').value;
//     const samount  = document.getElementById('samount').value;

//     if (parseInt(samount) > parseInt(tamount)) {
//         return;
//     }

//     const table = document.getElementById('myTable');
//     const row = table.insertRow();
    
    
    
   
    
//     const nameCell = row.insertCell(0); // <th>Goal Name</th>
//     nameCell.innerHTML = gname;

//     const prCell = row.insertCell(1); // <th>Target Amount</th>
//     prCell.innerHTML = tamount;

//     const tamountCell = row.insertCell(2);// <th>Target Date</th>
//     tamountCell.innerHTML = tdate ;
//                                             // <th>Category</th>
//     // const noteCell = row.insertCell(3); 
//     // noteCell.innerHTML = category;
                                             
//     const tdateCell = row.insertCell(3);// <th>Additional note </th>
//     tdateCell.innerHTML =note ;

     
// }



