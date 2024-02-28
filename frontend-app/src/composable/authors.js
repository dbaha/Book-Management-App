import {ref} from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

axios.defaults.baseURL="http://127.0.0.1:8000/api/";

export default function dataAuthors(){
    const authors = ref([]);
    const author = ref([]);
    const errors = ref({});
    const router = useRouter();
    const token=localStorage.getItem('token');

    const getAuthors= async ()=>{
        const response = await axios.get("authors",{
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
        authors.value=response.data.data;
    };

    const getAuthor = async(id)=>{
        const response = await axios.get("authors/" + id,{
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
        author.value=response.data;
    };

    const storeAuthor = async(data)=>{
        try{
            await axios.post("authors",data,{
                headers: {
                  Authorization: `Bearer ${token}`
                }
              });
            //push data pake name, lempar ke display semua data 
            await router.push({name:"AuthorIndex"});
        }catch(error){
            if(error.response.status === 422){
                errors.value = error.response.data.errors;
            }
        }
    };

    const updateAuthor = async(id)=>{
        try{
            await axios.put("authors/"+id,author.value,{
                headers: {
                  Authorization: `Bearer ${token}`
                }
              });
            //push data pake name, lempar ke display semua data 
            await router.push({name:"AuthorIndex"});
        }catch(error){
            if(error.response.status === 422){
                errors.value = error.response.data.errors;
            }
        }
    };

    const destroyAuthor = async(id) =>{
        if(!window.confirm("削除しますか？")){
            return;
        }
        await axios.delete("authors/"+id,{
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
        await getAuthors();
    };

    return{
        author,
        authors,
        getAuthor,
        getAuthors,
        storeAuthor,
        updateAuthor,
        destroyAuthor,
        errors,
    };
}