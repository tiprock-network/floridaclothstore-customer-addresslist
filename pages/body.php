<?php include 'contributors.php'; ?>
<div class="main-container">
        <div class="form-head">
            <h1>Florida Cloth Store - Westlands NRB-KE Branch</h1>
           
            <p>Hi <?php echo explode(' ',$username)[0]; ?>, the customer address list is ready below.</p>
        </div>
        <div class="field navigation">
            <nav>
                <ul>
                    <form method="POST" action="">
                        <li><a href="index.php"><button type="submit" name="submit"><i class="fa fa-person-circle-xmark"></i> Sign out</button></a> <b>---</b></li>
                        <li onclick="scrollToFrom()"><i class="fa fa-pencil"></i> Fill in form </li>
                    </form>
                    
                </ul>
            </nav>
        </div>
        <div class="search-form">
            <div class="field info">
            
                <p><i class="fa fa-list-ol"></i> <strong>Customer list</strong></p>
                <p>Below is a list of customers avaible in the store, this list can be used to generate a CSV file for mailing purposes.</p>
            
                <input type="text" name="usearch" id="usearch" style="width:95%; background: #fff; border-bottom: 1px solid rgb(211, 37, 37); padding:10px" placeholder="Search for customer using registration number"> <i class="fa fa-magnifying-glass"></i>
                <br>
                <br>
                <table>
                    <thead>
                        <tr>
                        <th><i class="fa fa-address-card"></i> Registration number</th>
                        <th><i class="fa fa-id-badge"></i> Name</th>
                        <th><i class="fa fa-square-phone-flip"></i> Phone</th>
                        <th><i class="fa fa-envelope-circle-check"></i> Email</th>
                        <th><i class="fa fa-location-dot"></i> Physical Address</th>
                        <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="custTbl">
                        <!--<tr>
                            <td>value</td>
                            <td>value</td>
                            <td>value</td>
                        </tr>-->
                    </tbody>
                </table>

                <!--list function buttons-->
                <button onclick="downloadCSVFile()"><i class="fa fa-file-csv"></i> Download CSV</button>
                <!--end of buttons section-->
                
            </div>
            <div class="field info">
                <p><b>Fill in this form</b></p>
                <p>With this form you are able to add a customer to your store and search for them anytime or even create a CSV file that can be used as a mailing list.</p>
            </div>
            <form id="addCustomerToList">
                <div class="field">
                    <label for="reg"><i class="fa fa-address-card"></i> Customer Registration Number</label>
                    <br>
                    <br>
                    <p>Customer registration number is generated automatically by the system after every second.</p>
                    <br>
                    <p>Registration number: <strong id="regTime"><?php echo 'CUST-'.date("yndHis");?></strong></p>
                </div>

                <div class="field">
                    <label for="uname">Name</label>
                    <br>
                    <input type="text" name="uname" id="uname" placeholder="e.g. Janet Juma">
                </div>

                <div class="field">
                    <label for="uemail">Email</label>
                    <br>
                    <input type="email" name="uemail" id="uemail" placeholder="e.g. janetjuma@example.com">
                </div>

                <div class="field">
                    <label for="addr">Address</label>
                    <br>
                    <input type="text" name="addr" id="addr" placeholder="e.g. Some Street, Building, Block Number, Apt. Number, Town">
                </div>

                <div class="field">
                    <label for="phone">Phone Number</label>
                    <br>
                    <input type="text" name="phone" id="phone" placeholder="e.g. +254709001230">
                </div>

                <div class="field">
                    <button type="submit"><i class="fa fa-user-plus"></i> Add Customer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const regNoSearch=document.getElementById('usearch');
        regNoSearch.addEventListener('input',e=>{
                if(regNoSearch.value==='')fetch_customers();
                else findCustomer(regNoSearch.value);
        });

        function fetch_customers(){
            fetch('../config/scripts.php')
            .then(res=>res.json())
            .then(customers=>{
                const customer=document.getElementById('custTbl');
                customer.innerHTML='';

                //check if array is not empty
                if(customers.length!==0){
                    customers.forEach(row=>{
                    const tuple=document.createElement('tr')
                    tuple.innerHTML=`<td>${row.custRegNo}</td> <td>${row.custName}</td> <td>${row.custPhone}</td> <td>${row.custEmail}</td> <td>${row.custAddress}</td><td><i class="fa fa-trash-can" onclick="deleteCustomer('${row.custRegNo}')"></i></td>`
                    customer.appendChild(tuple)
                })
                }else{
                    const statement=document.createElement('tr')
                    statement.innerHTML=`<td colspan=6><b>No results found</b></td>`;
                    customer.appendChild(statement)
                }
            })
            .catch(err=>console.log('Error: '+err));
        }

        //call function fetch_customers
        fetch_customers()


        //fetch single customer
         //removing a customer from the list
         function findCustomer(custid){
            

            fetch(`../config/fetchcust.php?custId=${custid}`,{method:'GET'})
            .then(res=>res.json())
            .then(customer=>{
                const customerTbl=document.getElementById('custTbl');
                customerTbl.innerHTML=''
              
                

                if(customer){
                    const tuple=document.createElement('tr')
                    tuple.innerHTML=`<td>${customer.custRegNo}</td> <td>${customer.custName}</td> <td>${customer.custPhone}</td> <td>${customer.custEmail}</td> <td>${customer.custAddress}</td><td><i class="fa fa-trash-can" onclick="deleteCustomer('${customer.custRegNo}')"></i></td>`
                    customerTbl.appendChild(tuple)
                }else{
                    const statement=document.createElement('tr')
                    statement.innerHTML=`<td colspan=6><b>No results found</b></td>`;
                    customerTbl.appendChild(statement)
                }
                
            })
            .catch(err=>console.log(err))
        }

        //function to insertData
        function add_customer(name,email,phone,address){
            fetch('../config/scripts.php',{
                method:'POST',
                headers:{'Content-Type':'application/x-www-form-urlencoded'},
                body:`uname=${name}&uemail=${email}&phone=${phone}&addr=${address}`

            })
            .then(res=>{
                if(res.ok) fetch_customers();
                else console.log(res.statusText)
            })
            .catch(err=>console.log(err))
        }

        //listen for form submission
        const myform=document.getElementById('addCustomerToList')
        myform.addEventListener('submit',e=>{
            //e.preventDefault();
            const uname=document.getElementById('uname').value.trim()
            const uemail=document.getElementById('uemail').value.trim()
            const phone=convertPhoneNumber(document.getElementById('phone').value.trim())
            const addr=document.getElementById('addr').value.trim()
            if(uname !==''&&uemail !==''){
                add_customer(uname,uemail,phone,addr);
                
            }

        })

        //removing a customer from the list
        function deleteCustomer(custid){
            

            fetch(`../config/scripts.php?custId=${custid}`,{method:'DELETE'})
            .then(res=>{
                if(res.ok)fetch_customers()
            })
            .catch(err=>console.log(err))
        }

        //create csv file for the list of customers
        function downloadCSVFile(){
            window.location.href='../config/genCSV.php'
        }

        //dynamic time
        setTimeout(function () {
        var date = new Date();
        var timeFormat = date.getFullYear().toString().slice(-2) + (date.getMonth() + 1) + date.getDate() + (date.getHours()-1) + date.getMinutes() + date.getSeconds();
        document.getElementById("regTime").textContent = `CUST-${timeFormat}`;
        setTimeout(arguments.callee, 1000); // Repeat the function every second
    }, 1000);

        //scroll to where the form is
        function scrollToFrom(){
            window.scrollTo(0,600);
        }

        //format phone number to 254 standard
        function convertPhoneNumber(number) {
            if (number.startsWith('0')) {
                number = '+254' + number.substring(1);
            }
            return number;
        }
    </script>
