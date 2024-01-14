import './App.css';
import { useState, useEffect } from 'react';
import { Carousel } from 'react-responsive-carousel';
import 'react-responsive-carousel/lib/styles/carousel.min.css';

function App() {
  const [itemData, setItemData] = useState([]);
  const [allItemData, setAllItemData] = useState([]);
  const [dropdownValue, setDropdownValue] = useState([])
  const [filter, setFilter] = useState();


    useEffect(() => {
    fetch('http://localhost:8080/data')
        .then((response)=> {
          return response.json();
        })
        .then((data) => {
          setItemData(data.data);
          setAllItemData(data.data)
              });
  }, []);

    const handleDiscountDropdownChange = (event) => {
        const selectedDiscount = event.target.value;
        setDropdownValue(selectedDiscount)

        if (selectedDiscount === 'all') {
            setItemData(allItemData)
        } else {

            const filteredItems = allItemData.filter(item => item.discount_percentage === selectedDiscount);
            setItemData(filteredItems);
        }
    }

    const handleHotelDropdownChange = (event) => {
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
                  <select value={dropdownValue} onChange={handleDiscountDropdownChange} >
                      <option defaultValue='all'>All</option>
                      {[...new Set(allItemData.map(item => item.discount_percentage))].map(discount => (
                          <option key={discount} value={discount} >{discount}</option>
                      ))}
                  </select>
              </div>
              ) : (
              <div>
                  <br/>
                  <select value={dropdownValue} onChange={handleHotelDropdownChange} >
                      <option defaultValue='All'>All</option>
                      {allItemData.map((item) => (
                          <option key={item.id} value={item.name} >{item.name}</option>
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
