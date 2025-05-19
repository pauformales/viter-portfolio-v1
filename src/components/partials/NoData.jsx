import React from "react";
import { FaRegFolder } from "react-icons/fa";

const NoData = () => {
  return (
    <div className="flex justify-center items-center flex-col pt-2">
      <FaRegFolder className="h-14 w-14 text-gray-300" />
      <span className="text-gray-300 text-xl">No Data</span>
    </div>
  );
};

export default NoData;
