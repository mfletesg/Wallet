import React, { Component} from 'react'
import ReactDOM from 'react-dom'
import TransferForm from './TransferForm'
import TransferList from './TransferList'

export default class Example extends Component{
    constructor(props){
        super(props)

        this.state = {
            money : 0.0,
            transfers: [],
            error: null,
            form: {
                description: '',
                amount: '',
                wallet_id: 1,
            }
        }
        this.handleChange = this.handleChange.bind(this)
    }

    handleChange(e){
        console.log(e.target.value);
        this.setState({
            form: {
                ...this.state.form, //Soluciona el error del js, mantine todo lo que se encuentra em this.state
                [e.target.name] : e.target.value
            }
        })
    }

    async componentDidMount(){
        try {
            let res = await fetch('http://127.0.0.1:8000/api/wallet')
            let data = await res.json()

            this.setState({ //Guardamos lo que recibimos en la variables de estado
                money: data.money,
                transfers: data.transfers
            })
        } catch (error) {
            this.setState({
                error
            })
        } finally {

        }
    }

    render(){
        return (
            <div className="container">

                <div className="row justify-content-center">
                    <div className="col-md-12 m-t-md">
                        <p className="title">$ {this.state.money}</p>
                    </div>
    				<div className="col-md-12">
                        <TransferForm form={this.state.form} onChange={this.handleChange}/>
    				</div>
                </div>

    			<div className="m-t-md">
                    <TransferList transfers={this.state.transfers}/>
    			</div>

            </div>
        );
    }
}


if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
