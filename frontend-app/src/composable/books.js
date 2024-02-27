import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

axios.defaults.baseURL="http://127.0.0.1:8000/api/";

export default function dataBooks(){
    const books = ref([]);
    const book = ref([]);
    const errors = ref({});
    const router = useRouter();

    const getBooks = async ()=>{
        const response = await axios.get("books");
        books.value= response.data.data;
    };


    const getBook = async(id)=>{
        const response = await axios.get('books/'+id);
        book.value=response.data;
    }

    const storeBook = async (data)=>{
        try{
            await axios.post("books",data);
            await router.push({name:"BookIndex"});
        }catch(error){
            console.log(error);
            if(error.response.status === 422){
                errors.value = error.response.data.errors;
            }
        }
    }
    const updateBook = async(id)=>{
        try{
            await axios.put("books/"+id,author.value);
            await router.push({name:"BookIndex"});
        }catch(error){
            if(error.response.status === 422){
                errors.value = error.response.data.errors;
            }
        }
    };

    const destroyBook = async(id) =>{
        if(!window.confirm("削除しますか？")){
            return;
        }
        await axios.delete("books/"+id);
        await getAuthors();
    };

    return{
        book,
        books,
        getBooks,
        getBook,
        storeBook,
        updateBook,
        destroyBook,
        errors,
    }
}