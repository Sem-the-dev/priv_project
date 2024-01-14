import './App.css';
import { useState, useEffect } from 'react';
import { Carousel } from 'react-responsive-carousel';
import 'react-responsive-carousel/lib/styles/carousel.min.css';

function App() {
  const [itemData, setItemData] = useState([]);


  useEffect(() => {
    fetch('http://localhost:8080/data')
        .then((response)=> {
          return response.json();
        })
        .then((data) => {
          // console.log(data.data);
          setItemData(data.data);

              });
  }, []);

    return (
    <div className="App">
      <header className="App-header">
        <h1>Welcome</h1>
          <Carousel>
              {itemData.map((item) => (
                  <div key={item.id}>
                      <img src={item.image} />
                      <p className="legend">{item.name} --> {item.discount_percentage}% discount</p>
                  </div>
              ))}
          </Carousel>
      </header>
    </div>
  );
}

export default App;
