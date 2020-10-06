<template>
<div>

        <div class="site-section block-3 site-blocks-2 bg-light">
<div v-if="this.success" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>done</strong> .
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Add Product</h2>


            
          </div>
        </div>


<form  v-on:submit.prevent="suba()" enctype="multipart/form-data">
@csrf
        <div class="row">
          <div class="col-6 col-md-4">  <div class="form-group">
            <h6 class="text-uppercase">country</h6>
            <select name="country" v-model="country" class="form-control" id="exampleFormControlSelect1">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div></div>
     
        </div>  
          
        <div class="row">
          <div class="col-6 col-md-4">  <div class="form-group">
            <h6 class="text-uppercase">Link</h6>
            <input type="text" v-model="Link"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

          </div></div>
     
        </div>


        <div class="row">
          <div class="col-6 col-md-4"> 
  <div class="form-group">
            <h6 class="text-uppercase">category</h6>
            <select name="category_id" v-model="category_id" class="form-control" id="exampleFormControlSelect1">
              <option>1</option>
              <option>2</option>
 <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div></div>

          <div class="col-6 col-md-4">  <div class="form-group">
          
            <h6 class="text-uppercase">quntity</h6>
            <input type="number" v-model="quantity" name="quantity" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
   
          </div>
        </div>
          <div class="col-6 col-md-4">  <div class="form-group">
            <h6 class="text-uppercase">name</h6>
            <input type="text" name="name" v-model="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         
          </div></div>
        </div>

        <div class="row">
          <div class="col-6 col-md-4">  <div class="form-group">
        
            <h6 class="text-uppercase">color</h6>
            <input type="text" name="color" v-model="color"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      
          </div></div>
          <div class="col-6 col-md-4">  <div class="form-group">
            <h6 class="text-uppercase">size</h6>
            <input type="text"  name="size" v-model="size" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
          
          </div>
        </div>
          <div class="col-6 col-md-4">  <div class="form-group">
  
            <h6 class="text-uppercase">price</h6>
            <input type="number" name="price"  v-model="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  
          </div></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
       </form>
        </div>
 
      </div>
    </div>


</template>

<script>
    export default {

data(){
    return{
category_id:'',
quantity:'',
country:'',
Link:'',
quantity:'',
name:'',
color:'',
size:'',
success:false,
price:''
    }

},
methods:{

  suba(){
this.allerros=[];
this.success = false

 const config = {

                    headers: { 'content-type': 'multipart/form-data' }

                }

 

                let formData = new FormData();

              
 formData.append('price', this.price);
 formData.append('Link', this.Link);
  formData.append('quantity', this.quantity);
  formData.append('name', this.name);
formData.append('color', this.color);
formData.append('country', this.country);
formData.append('size', this.size);
formData.append('category_id', this.category_id);
axios.post('/se', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
}).then((response)=>{
    this.success = true;
this.name='',
this.price='',
this.country='',
this.color='',
this.size='',
this.quantity='',
this.Link='',
this.category_id = ''
}).catch((error) => {
                         if (error.response.status == 422){
       this.allerros = error.response.data.errors;
      }

                       
                   });

}


},

 
    }

</script>
