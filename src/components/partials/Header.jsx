import React from "react";
import FtcLogoHeader from "../../assets/svg/SvgComponent";
import { StoreContext } from "../../../store/StoreContext";
import ModalSuccess from "./modal/ModalSuccess";
import ModalError from "./modal/ModalError";
import SvgComponent from "../../assets/svg/SvgComponent";

const Header = () => {
  const { store, dispatch } = React.useContext(StoreContext);

  return (
    <>
      <div className="sticky top-0 z-20 flex items-center justify-between h-16 border-solid border-b-2 border-accent bg-primary px-2">
        <div>
          <SvgComponent />
        </div>

        <div>
          <div className="rounded-full bg-accent h-8 w-8 flex items-center justify-center text-white">
            <span className="block">J</span>
            <span className="block">P</span>
          </div>
        </div>
      </div>

      {store.success && <ModalSuccess />}
      {store.error && <ModalError />}
    </>
  );
};

export default Header;
