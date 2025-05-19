import React from "react";

const TableLoading = ({ count = null, cols = null }) => {
  const box = [];
  let i;

  let innerbox = () => {
    while (count % cols !== 0) {
      count++;
    }
    return count;
  };

  for (i = 1; i <= innerbox(); i++) {
    box.push(
      <div
        key={i}
        className="bg-gray-300 p-1.5 h-[7px] w-full rounded-md relative loading-bar overflow-hidden"
      ></div>
    );
  }

  if (cols !== 0) {
    return (
      <div
        className="grid p-2 gap-2 md:gap-4"
        style={{ gridTemplateColumns: `repeat(${cols}, 1fr)` }}
      >
        {box}
      </div>
    );
  }
  return <div></div>;
};

export default TableLoading;
