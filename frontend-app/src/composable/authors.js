import {ref} from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

axios.defaults.baseURL="http://127.0.0.1:8000/api/";

export default function dataAuthors(){
    const authors = ref([]);
    const author = ref([]);
    const errors = ref({});
    const router = useRouter();

    const getAuthors= async ()=>{
        const response = await axios.get("authors");
        authors.value=response.data.data;
    };

    const getAuthor = async(id)=>{
        const response = await axios.get("authors/" + id);
        author.value=response.data;
    };

    const storeAuthor = async(data)=>{
        try{
            await axios.post("authors",data);
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
            await axios.put("authors/"+id,author.value);
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
        await axios.delete("authors/"+id);
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