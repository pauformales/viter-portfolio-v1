import React from "react";
import { setError, setIsSearch, setMessage } from "../../../store/StoreAction";
import { FaSearch } from "react-icons/fa";

const SearchBarWithFilterStatus = ({
  search,
  dispatch,
  store,
  result,
  isFetching,
  setOnSearch,
  onSearch,
  isFilter = false,
}) => {
  const handleChange = (e) => {
    if (e.target.value === "") {
      setOnSearch(false);
      dispatch(setIsSearch(false));
    }
    if (isFilter === true) {
      dispatch(setIsSearch(true));
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    let val = e.target.value;

    if (val === "" || val === " ") {
      setOnSearch(false);
      dispatch(setIsSearch(false));
      dispatch(setError(true));
      dispatch(setMessage("Search keyword cannot be blank."));
    } else {
      setOnSearch(true);
      dispatch(setIsSearch(true));
    }
  };

  return (
    <>
      <form onSubmit={(e) => handleSubmit(e)}>
        <div className="relative">
          <span className="absolute left-2.5 top-2.5">
            <FaSearch />
          </span>
          <input
            type="search"
            placeholder="Search here..."
            className="text-xs py-1 h-8 pl-7"
            ref={search}
            onChange={(e) => handleChange(e)}
          />
        </div>
      </form>
    </>
  );
};

export default SearchBarWithFilterStatus;
