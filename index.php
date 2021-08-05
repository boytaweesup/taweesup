<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA EMPLOYEE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</head>
<body>
    <div class="container" id="app" >
        <h2 align="center">DATA EMPLOYEE</h2> <hr>
        <div class="row">
            <div class="col-md-12">
                <form @submit="submitData" @reset="resetData" method="post">
                    <div class="form-group">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Firstname</span>
                        <input v-model="form.fname" type="text" class="form-control" placeholder="Firstname" aria-label="Firstname">
                        <span class="input-group-text">Lastname</span>
                        <input v-model="form.lname" type="text" class="form-control" placeholder="Lastname" aria-label="Lastname">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Birthday</span>
                        <input v-model="form.birthday" type="date" class="form-control" placeholder="Birthday" aria-label="Firstname">
                        <span class="input-group-text">Email</span>
                        <input v-model="form.email" type="text" class="form-control" placeholder="Email" aria-label="Lastname">
                    </div>
                    </div>
                    
                    <input type="submit" v-model="form.status" class="btn btn-success">
                    <input type="reset" value="CANCEL" class="btn btn-danger">
                </form>
                <div class="py-2">
                   
                </div>
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Birthday</th>
                    <th scope="col">Email</th>
                    <th scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in users">
                    <!-- <th scope="row">{{row.id}}</th> -->
                    <td scope="row">{{row.fname}}</td>
                    <td scope="row">{{row.lname}}</td>
                    <td>{{row.birthday}}</td>
                    <td>{{row.email}}</td>
                    <td><button class="btn btn-primary" @click="editUser(row.id)">Update</button>
                    <button class="btn btn-danger" @click="deleteUser(row.id)">Delete</button></td>
                    </tr>
                    
                </tbody>
                </table>

            </div>
        </div>
    </div>
    
</body>
<script src="app.js"></script>
</html>