import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

axios.defaults.baseURL="http://127.0.0.1:8000/api/";

export default function dataBooks(){
    const books = ref([]);
    const book = ref([]);
    const errors = ref({});
    const router = useRouter();
    const token= localStorage.getItem('token');

    const getBooks = async ()=>{
        const response = await axios.get("books",{
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
        books.value= response.data.data;
    };


    const getBook = async(id)=>{
        const response = await axios.get('books/'+id,{
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
        book.value=response.data;
    }

    const storeBook = async (data)=>{
        try{
            await axios.post("books",data,{
                headers: {
                  Authorization: `Bearer ${token}`
                }
              });
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
            await axios.put("books/"+id,book.value,{
                headers: {
                  Authorization: `Bearer ${token}`
                }
              });
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
        await axios.delete("books/"+id,{
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
        await getBooks();
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