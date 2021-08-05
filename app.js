var app = new Vue({
    el: '#app',
    data:{
        users:"",
        
        form:{
            id:"",
            fname:"",
            lname:"",
            birthday:"",
            email:"",
            isEdit:false,
            status:"SAVE"
        }
    },
    methods:{
        submitData(e){
            e.preventDefault();
            check = (this.form.fname != "" && this.form.lname !="" && this.form.birthday !="" && this.form.email !="");
            if(check && !this.form.isEdit){
                //SAVE
                axios.post("action.php",{
                    fname:this.form.fname,
                    lname:this.form.lname,
                    birthday:this.form.birthday,
                    email:this.form.email,
                    action:"insert"
                }).then(function(res){
                    app.resetData();
                    app.getAllUsers();
                })
            }
            if(check && this.form.isEdit){
                //Update
                axios.post("action.php",{
                    id:this.form.id,
                    fname:this.form.fname,
                    lname:this.form.lname,
                    birthday:this.form.birthday,
                    email:this.form.email,
                    action:"update"
                }).then(function(res){
                    app.resetData();
                    app.getAllUsers();
                })
                    console.log("Update Data");
            }
            console.log(this.form.fname);
            console.log(this.form.lname);
            console.log(this.form.birthday);
            console.log(this.form.email);
            console.log("save");
        },
        resetData(e){
            this.form.id="";
            this.form.fname="";
            this.form.lname="";
            this.form.birthday="";
            this.form.email="";
            this.form.status="SAVE";
            console.log("clear");
        },
        getAllUsers(){
            axios.post("action.php",{
                action:"getAll"
            }).then(function(res){
                app.users=res.data
                console.log(app.users);
            }).catch((err) => {
                console.log(err.response.data.message)
            })
        },
        editUser(id){
            console.log(id);
            this.form.status="Update";
            this.form.isEdit=true;

            axios.post("action.php",{
                action:"geteditUser",
                id:id
            }).then(function(res){
                app.form.id=res.data.id;
                app.form.fname=res.data.fname;
                app.form.lname=res.data.lname;
                app.form.birthday=res.data.birthday;
                app.form.email=res.data.email;
            })
        },
        deleteUser(id){
            if(confirm("Do you want to remove "+id+"?")){
                axios.post("action.php",{
                    action:"getdeleteUser",
                    id:id
                }).then(function(res){
                    console.log(res.data.message);
                    app.resetData();
                    app.getAllUsers();
                })
            }
            
        }
    },
    created(){
        this.getAllUsers();
    }
})