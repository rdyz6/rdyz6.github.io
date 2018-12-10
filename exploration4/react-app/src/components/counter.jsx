import React, {Component} from 'react';
class Counter extends Component{
//    state = {
//        value:this.props.counter.value,
//        tags:['tag1','tag2','tag3']
//        //imageUrl:'https://picsum.photos/200'
//        
//    };
//    constructor(){
//        super();
//        this.handleIncrement = this.handleIncrement.bind(this);
//    }
    styles = {
        fontSize:15,
        fontWeight: "bold"
        //imageUrl:'https://picsum.photos/200'
        
    };
//      handleIncrement = () => {
//          
//          this.setState({value:this.state.value+1});
//      }
      
//      handleReset = () => {
//          
//          const counters = this.state.counters.map(c=>{c.value = 0;return c;});
//          this.setState({});
//      }
//      
      

//    handleIncrement(){
//        console.log("click",this);
//        
//    }
    render(){
        console.log(this.props);
        
        
        return(
               <div>
               
               <span style = {this.styles} className={this.getBadgeClasses()}>{this.formatCount()}</span>
               <button 
                   onClick = {()=>this.props.onIncrement(this.props.counter)} className="btn btn-secondary btn-sm">Increment
               </button>
                <button 
                   onClick = {()=>this.props.onDecrement(this.props.counter)} className="btn btn-primary btn-sm">Decrement
               </button>
                <button onClick = {()=>this.props.onDelete(this.props.counter.id)} className="btn btn-danger btn-sm m-2">Delete
                </button>
               
               </div>
        );
    }

getBadgeClasses(){
    let classes = "badge m-2 badge-";
    classes += this.props.counter.value === 0 ? "warning":"primary";
    return classes;
}
    
formatCount(){
    const{value} = this.props.counter;
    return value === 0 ? "Zero" : value;
}
}
export default Counter;