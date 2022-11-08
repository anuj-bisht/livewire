<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Comments;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;
    // isko use krnai sai page refresh nhi hoga



    // public $data ;  ----> hmai yai ab htana pdaiga becs of pagination. ab is data ko hum render fn. kai andar pass kraigai
                            //  becs pagination iskai sath kaam nhi krta


    // =
    // [
    //     [
    //         'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt atque',
    //         'created_at' => '1 min ago',
    //         'creator' => 'Anuj'
    //     ]
    // ];
    public $newComment;
    public $newName;
    public $message='Please Submit Add All fields';



public function mount($com){

    // $this->data= $com;
}
public function updated($field){
    $this->validateOnly($field,[
        'newComment'=>'required|max:30'
    ]);
}


    public function addComment()
    {
        // $this->validate([
        //     'newComment'=>'required'
        // ]);
        // if($this->newName=="" && $this->newComment==""){
        //       return ;
        // } 
        // \array_unshift($this->data, [
        //     'body' => $this->newComment,
        //     'created_at' => Carbon::now()->diffForHumans(),
        //     'creator' => $this->newName,
        // ]);
        // dd($this->newComment, $this->newName); 
        $new_one=Comments::create(['body' => $this->newComment,
        'created_at' => Carbon::now()->diffForHumans(),
        'user_id' => $this->newName,
        ]);



        // $this->data->prepend($new_one);
        //prepend used to insert 1st and push use to insert last


        session()->flash('message','Comment Add Successfully 😊');

    }

public function remove($commentId){
    $comment= Comments::find($commentId);
    $comment->delete();
    // $this->data=$this->data->where('id','!=',$commentId);

    // $this->data=$this->data->except($commentId);   -------> ab hmai yha sai bhi $this->data htana pdaiga kyuki isko to ab hmnai comment kar diya hai
                                                            //    becs data ab hum render kai andar pass kar rhai hai
    session()->flash('message','Comment Delete Successfully 😒');

}
    // view:model sai is newComment ko bind kar diya hai

    public function render()
    {
        $data=Comments::paginate(2);
        return view('livewire.comment', compact('data'));
    }
}
