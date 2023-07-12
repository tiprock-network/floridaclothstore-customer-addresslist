<?php include 'contributors.php'; ?>
<div class="main-container">
        <div class="form-head">
            <h1>Florida Cloth Store - Westlands NRB-KE Branch</h1>
           
            <p>Hi <?php echo explode(' ',$username)[0]; ?>, the customer address list is ready below.</p>
        </div>
        <div class="field navigation">
            <nav>
                <ul>
                        <li><a href="login.php" style="font-size: 18px;"><i class="fa fa-person-circle-plus"></i> Sign in</a></li>
                </ul>
            </nav>
        </div>
        <div class="search-form">
            <div class="field info">
                <input type="text" name="usearch" id="usearch" style="width:95%; background: #fff; border-bottom: 1px solid rgb(211, 37, 37); padding:10px" value="You need to login to use list" readonly></i>
                <br>
                <br>
                <table>
                    <thead>
                        <tr>
                        <th><i class="fa fa-id-badge"></i> Name</th>
                        <th><i class="fa fa-square-phone-flip"></i> Phone</th>
                        <th><i class="fa fa-envelope-circle-check"></i> Email</th>
                        </tr>
                    </thead>
                    <tbody id="custTbl">
                        <!--<tr>
                            <td>CUS-236081903</td>
                            <td>Theophilus Owiti</td>
                            <td>0756896700</td>
                            <td>lincolntheop@gmail.com</td>
                            <td>Eldama Ravine Rd, Nairobi, Kabarak University, Nakuru, KE</td>
                            <td><i class="fa fa-trash-can"></i></td>
                        </tr>-->

                        
                    </tbody>
                </table>

                
                
            </div>
            
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
                    tuple.innerHTML=`<td>${row.custName}</td> <td>${row.custPhone}</td> <td>${row.custEmail}</td>`;
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


        

        
    </script>
