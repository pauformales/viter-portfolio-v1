import React from "react";

const ModalWrapperSide = ({
  children,
  handleClose = () => {},
  className = "",
}) => {
  return (
    <>
      <div className="modal__wrapper fixed top-0 bottom-0 right-0 left-0 flex items-center justify-center z-40">
        <div className="w-screen h-screen backdrop" onClick={handleClose}></div>
        <div
          className={`absolute mx-1.5 pb-[50px] md:pb-0 bg-white border-gray-200 top-0 right-[-5px] w-full md:w-[30rem] shadow-xl transition-all ease-linear duration-200 ${className}`}
        >
          <div className={`h-dvh overflow-y-auto px-6`}>{children}</div>
        </div>
      </div>
    </>
  );
};

export default ModalWrapperSide;
