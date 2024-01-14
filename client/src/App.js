import './App.css';
import { useState, useEffect } from 'react';
import { Carousel } from 'react-responsive-carousel';
import 'react-responsive-carousel/lib/styles/carousel.min.css';

function App() {
  const [itemData, setItemData] = useState([]);
  const [allItemData, setAllItemData] = useState([]);
  const [discount, setDiscount] = useState(null)
  const [dropdownValue, setDropdownValue] = useState([])
  const [filter, setFilter] = useState();


    useEffect(() => {
    fetch('http://localhost:8080/data')
        .then((response)=> {
          return response.json();
        })
        .then((data) => {
          console.log(data);
          setItemData(data.data);
          setAllItemData(data.data)
              });
  }, []);

    const handleChange = (event) => {
        const selectedDiscount = event.target.value;
        setDiscount(selectedDiscount)

        if (selectedDiscount === 'all') {
            setItemData(allItemData)
        } else {
            const filteredItems = allItemData.filter(item => item.discount_percentage === selectedDiscount);
            setItemData(filteredItems);
        }
    }

    const handleDropdownChange = (event) => {
        const selectedHotel = event.target.value;
        setDropdownValue(selectedHotel)

        if (selectedHotel === 'All') {
            setItemData(allItemData);
        } else {
            const theSelectedHotelInfo = allItemData.filter(item => item.name === selectedHotel);
            setItemData(theSelectedHotelInfo);
        }
    }

    return (
    <div className="App">
      <header className="App-header">
        <h1>Welcome</h1>
          <div>
              <form>

              <div>
                  <span>Filter by: </span>

                  <label>
                      <input type="radio" value="discount" checked={filter === 'discount'} onChange={() => setFilter('discount')} />
                      Discount
                  </label>
                  <label >
                      <input type="radio" value="name" checked={filter === 'name' } onChange={() => setFilter('name')} />
                      Hotel name
                  </label>
              </div>

              <br/>
              {filter === 'discount' ? (
              <div>
                  <label>
                      <input type="radio" value="all" defaultChecked={true} checked={discount === 'all'} onChange={handleChange} />
                      All
                  </label>
                  <label >
                      <input type="radio" value="10" checked={discount === '10' } onChange={handleChange} />
                      10%
                  </label>

                  <label >
                      <input type="radio" value="15" checked={discount === '15'} onChange={handleChange} />
                      15%
                  </label>

                  <label >
                      <input type="radio" value="20" checked={discount === '20'} onChange={handleChange} />
                      20%
                  </label>
              </div>
              ) : (
              <div>
                  <br/>
                  <select value={dropdownValue} onChange={handleDropdownChange} >
                      <option defaultValue='All'>All</option>
                      {allItemData.map((item) => (
                          <option key={item.id} value={item.name} name={item.name}>{item.name}</option>
                      ))}
                  </select>
              </div>
              )}
              </form>
          </div>

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
