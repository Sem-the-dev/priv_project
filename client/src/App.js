import './App.css';
import { useState, useEffect } from 'react';

function App() {
  const [itemData, setItemData] = useState([]);


  useEffect(() => {
    fetch('http://localhost:8080/data')
        .then((response)=> {
          return response.json();
        })
        .then((data) => {
          console.log(data.data);
          setItemData(data.data);

              });
  }, []);
    console.log(itemData)
    return (
    <div className="App">
      <header className="App-header">
        <h1>Welcome</h1>

      </header>
    </div>
  );
}

export default App;
