import React from "react";
import { BiEdit, BiSave } from "react-icons/bi";
import { FaArchive, FaEdit, FaHistory, FaTrash } from "react-icons/fa";
import TableLoading from "../../../../partials/spinners/TableLoading";
import ServerError from "../../../../partials/ServerError";
import FetchingSpinner from "../../../../partials/spinners/FetchingSpinner";
import useQueryData from "../../../../helper/useQueryData";
import NoData from "../../../../partials/NoData";
import { StoreContext } from "../../../../../../store/StoreContext";
import {
  setArchive,
  setDelete,
  setRestore,
} from "../../../../../../store/StoreAction";
import ModalArchive from "../../../../partials/modal/ModalArchive";
import ModalRestore from "../../../../partials/modal/ModalRestore";
import ModalDelete from "../../../../partials/modal/ModalDelete";

const SettingsServiceList = ({ setItemEdit, setIsModal }) => {
  const { store, dispatch } = React.useContext(StoreContext);
  const [id, setId] = React.useState(null);
  const [dataItem, setDataItem] = React.useState(null);
  let count = 1;

  const [isLoaded, setIsLoaded] = React.useState(false);

  const {
    isLoading,
    isFetching,
    error,
    data: experience,
  } = useQueryData(
    `/rest/v1/controllers/developer/settings/experience/experience.php`,
    "get",
    "experience",
    {},
    null,
    true
  );

  const handleEdit = (item) => {
    setItemEdit(item);
    setIsModal(true);
  };

  const handleArchive = (item) => {
    setDataItem(item);
    setId(item.experience_aid);
    dispatch(setArchive(true));
  };

  const handleRestore = (item) => {
    setDataItem(item);
    setId(item.experience_aid);
    dispatch(setRestore(true));
  };

  const handleDelete = (item) => {
    setDataItem(item);
    setId(item.experience_aid);
    dispatch(setDelete(true));
  };

  return (
    <>
      <div className="relative rounded-md overflow-auto z-0">
        {isFetching && !isLoading && <FetchingSpinner />}
        <div className="overflow-auto">
          <table>
            <thead>
              <tr>
                <th className="w-[3rem]">#</th>
                <th className="w-[40rem]">Name</th>
                <th className="w-[15rem]">Description</th>
                <th colSpan="100%"></th>
              </tr>
            </thead>

            <tbody>
              {isLoading && (
                <>
                  <tr className="text-center">
                    <td colSpan="100%">
                      <TableLoading cols={2} count={20} />
                    </td>
                  </tr>
                </>
              )}

              {error && (
                <>
                  <tr className="text-center">
                    <td colSpan="100%">
                      <ServerError />
                    </td>
                  </tr>
                </>
              )}
              {/* IF DATA HAS NO COUNT*/}
              {experience?.count == 0 && (
                <>
                  <tr className="text-center">
                    <td colSpan="100%">
                      <NoData />
                    </td>
                  </tr>
                </>
              )}
              {/* IF DATA HAS COUNT */}
              {experience?.count > 0 &&
                experience.data.map((item, key) => {
                  return (
                    <tr key={key} className="group relative">
                      <td>{count++}.</td>
                      <td>{item.experience_title}</td>
                      <td className="max-w-[6rem] truncate">
                        {item.experience_description}
                      </td>
                      <td colSpan="100%">
                        <div className="flex gap-x-3 items-center justify-end pr-1">
                          {item.experience_is_active == 1 ? (
                            <>
                              <button
                                type="button"
                                className=" tooltip-action-table"
                                data-tooltip="Edit"
                                onClick={() => handleEdit(item)}
                              >
                                <FaEdit />
                              </button>
                              <button
                                type="button"
                                className=" tooltip-action-table"
                                data-tooltip="Archive"
                                onClick={() => handleArchive(item)}
                              >
                                <FaArchive />
                              </button>
                            </>
                          ) : (
                            <>
                              <button
                                type="button"
                                className=" tooltip-action-table"
                                data-tooltip="Restore"
                                onClick={() => handleRestore(item)}
                              >
                                <FaHistory />
                              </button>
                              <button
                                type="button"
                                className=" tooltip-action-table"
                                data-tooltip="Delete"
                                onClick={() => handleDelete(item)}
                              >
                                <FaTrash />
                              </button>
                            </>
                          )}
                        </div>
                      </td>
                    </tr>
                  );
                })}
            </tbody>
          </table>
        </div>
      </div>

      {store.archive && (
        <ModalArchive
          endpoint={`/rest/v1/controllers/developer/settings/experience/active.php?experienceid=${id}`}
          msg={`Are you sure want to archive this record?`}
          successMsg={`Successfully Archived`}
          queryKey={`experience`}
        />
      )}

      {store.restore && (
        <ModalRestore
          endpoint={`/rest/v1/controllers/developer/settings/experience/active.php?experienceid=${id}`}
          msg={`Are you sure want to restore this record?`}
          successMsg={`Successfully Restored`}
          queryKey={`experience`}
        />
      )}

      {store.delete && (
        <ModalDelete
          endpoint={`/rest/v1/controllers/developer/settings/experience/experience.php?experienceid=${id}`}
          msg={`Are you sure want to delete this record?`}
          successMsg={`Successfully Deleted.`}
          item={dataItem.experience_title}
          queryKey={`experience`}
        />
      )}
    </>
  );
};

export default SettingsServiceList;
