import React from "react";
import { StoreContext } from "../../../../store/StoreContext";
import { useMutation, useQueryClient } from "@tanstack/react-query";
import { queryData } from "../../helper/queryData";
import {
  setArchive,
  setError,
  setMessage,
  setRestore,
  setSuccess,
} from "../../../../store/StoreAction";
import { FaQuestion } from "react-icons/fa";

const ModalRestore = ({ endpoint, msg, successMsg, queryKey }) => {
  const { dispatch } = React.useContext(StoreContext);

  const queryClient = useQueryClient();
  const mutation = useMutation({
    mutationFn: (values) => queryData(endpoint, "put", values),
    onSuccess: (data) => {
      queryClient.invalidateQueries({ queryKey: [queryKey] });
      handleClose();

      if (!data.success) {
        // FAILED REQUEST
        dispatch(setError(true));
        dispatch(setMessage(data.error));
      } else {
        // SUCCESS REQUEST
        dispatch(setMessage(successMsg));
        dispatch(setSuccess(true));
      }
    },
  });

  const handleConfirm = async () => {
    // MUTATE OR SEND REQUEST UPON CLICK
    mutation.mutate({ isActive: 1 });
  };

  const handleClose = () => {
    dispatch(setRestore(false));
  };

  return (
    <>
      <div className="bg-dark/50 overflow-y-auto fixed top-0 right-0 bottom-0 left-0 z-50 flex justify-center items-center">
        <div className="p-1 w-[350px]">
          <div className="bg-white p-6 pt-10 text-center rounded-lg ">
            <FaQuestion className="mx-auto my-2 animate-bounce h-11 w-11 text-red-600" />
            <p className="text-sm pt-3 pb-5 text-primary">{msg}</p>
            <div className="flex items-center gap-1">
              <button
                type="submit"
                className="btn-modal-submit"
                disabled={mutation.isPending}
                onClick={handleConfirm}
              >
                {mutation.isPending ? "..." : "Confirm"}
              </button>
              <button
                type="reset"
                className="btn-modal-cancel"
                disabled={mutation.isPending}
                onClick={handleClose}
                autoFocus
              >
                Cancel
              </button>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default ModalRestore;
